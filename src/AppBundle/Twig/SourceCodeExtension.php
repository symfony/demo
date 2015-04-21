<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Twig;

/**
 * CAUTION: this is an extremely advanced Twig extension. It's used to get the
 * source code of the controller and the template used to render the current
 * page. If you are starting with Symfony, don't look at this code and consider
 * studying instead the code of the src/AppBundle/Twig/AppExtension.php extension.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class SourceCodeExtension extends \Twig_Extension
{
    protected $loader;
    protected $controller;
    protected $template;

    public function __construct(\Twig_LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('show_source_code', array($this, 'showSourceCode'), array('is_safe' => array('html'), 'needs_environment' => true)),
        );
    }

    public function showSourceCode(\Twig_Environment $twig, $template)
    {
        $this->template = $template;

        return $twig->render('default/_source_code.html.twig', array(
            'controller_source_code' => $this->getControllerCode(),
            'controller_file_path'   => $this->getControllerRelativePath(),
            'template_source_code'   => $this->getTemplateCode(),
            'template_file_path'     => $this->getTemplateRelativePath(),
        ));
    }

    private function getControllerCode()
    {
        // this happens for example for exceptions (404 errors, etc.)
        if (null === $this->controller) {
            return 'Not available';
        }

        $className = get_class($this->controller[0]);
        $class = new \ReflectionClass($className);
        $method = $class->getMethod($this->controller[1]);

        $classCode = file($class->getFilename());
        $methodCode = array_slice($classCode, $method->getStartline() - 1, $method->getEndLine() - $method->getStartline() + 1);
        $controllerCode = '    '.$method->getDocComment()."\n".implode('', $methodCode);

        return $this->unindentCode($controllerCode);
    }

    private function getControllerRelativePath()
    {
        // this happens for example for exceptions (404 errors, etc.)
        if (null === $this->controller) {
            return '';
        }

        $className = get_class($this->controller[0]);
        $class = new \ReflectionClass($className);

        $absolutePath = $class->getFilename();
        $pathParts = explode(DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR, $absolutePath);
        $relativePath = 'src'.DIRECTORY_SEPARATOR.$pathParts[1];

        return $relativePath;
    }

    private function getTemplateCode()
    {
        return $this->loader->getSource($this->template->getTemplateName());
    }

    /**
     * The logic implemented in this method is solely developed for the Symfony
     * Demo application and cannot be used as a general purpose solution.
     * Specifically, this logic won't work for templates that use a namespaced path
     * (e.g. @WebProfiler/Collector/time.html.twig) or any loader different from
     * Twig_Loader_Filesystem (e.g. TwigBundle:Exception:exception.txt.twig notation
     * or an anonymous template created by the {% embed %} tag).
     */
    private function getTemplateRelativePath()
    {
        return 'app/Resources/views/'.$this->template->getTemplateName();
    }

    /**
     * Utility method that "unindents" the given $code when all its lines start
     * with a tabulation of four white spaces.
     *
     * @param  string $code
     * @return string
     */
    private function unindentCode($code)
    {
        $formattedCode = '';
        $codeLines = explode("\n", $code);

        $indentedLines = array_filter($codeLines, function ($lineOfCode) {
            return '' === $lineOfCode || '    ' === substr($lineOfCode, 0, 4);
        });

        if (count($indentedLines) === count($codeLines)) {
            $formattedCode = array_map(function ($lineOfCode) { return substr($lineOfCode, 4); }, $codeLines);
            $formattedCode = implode("\n", $formattedCode);
        } else {
            $formattedCode = $code;
        }

        return $formattedCode;
    }

    // the name of the Twig extension must be unique in the application
    public function getName()
    {
        return 'app.source_code_extension';
    }
}
