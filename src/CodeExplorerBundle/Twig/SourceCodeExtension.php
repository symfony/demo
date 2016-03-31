<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeExplorerBundle\Twig;

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
    private $controller;
    private $kernelRootDir;

    public function __construct($kernelRootDir)
    {
        $this->kernelRootDir = $kernelRootDir;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('show_source_code', array($this, 'showSourceCode'), array('is_safe' => array('html'), 'needs_environment' => true)),
        );
    }

    public function showSourceCode(\Twig_Environment $twig, $template)
    {
        return $twig->render('@CodeExplorer/source_code.html.twig', array(
            'controller' => $this->getController(),
            'template'   => $this->getTemplateSource($twig->resolveTemplate($template)),
        ));
    }

    private function getController()
    {
        // this happens for example for exceptions (404 errors, etc.)
        if (null === $this->controller) {
            return;
        }

        $method = $this->getCallableReflector($this->controller);

        $classCode = file($method->getFileName());
        $methodCode = array_slice($classCode, $method->getStartLine() - 1, $method->getEndLine() - $method->getStartLine() + 1);
        $controllerCode = '    '.$method->getDocComment()."\n".implode('', $methodCode);

        return array(
            'file_path' => $method->getFileName(),
            'starting_line' => $method->getStartLine(),
            'source_code' => $this->unindentCode($controllerCode)
        );
    }

    /**
     * Gets a reflector for a callable.
     *
     * This logic is copied from Symfony\Component\HttpKernel\Controller\ControllerResolver::getArguments
     *
     * @param callable $callable
     *
     * @return \ReflectionFunctionAbstract
     */
    private function getCallableReflector($callable)
    {
        if (is_array($callable)) {
            return new \ReflectionMethod($callable[0], $callable[1]);
        }

        if (is_object($callable) && !$callable instanceof \Closure) {
            $r = new \ReflectionObject($callable);

            return $r->getMethod('__invoke');
        }

        return new \ReflectionFunction($callable);
    }

    private function getTemplateSource(\Twig_Template $template)
    {
        return array(
            // Twig templates are not always stored in files, and so there is no
            // API to get the filename from a template name in a generic way.
            // The logic used here works only for templates stored in app/Resources/views
            // and referenced via the "filename.html.twig" notation, not via the "::filename.html.twig"
            // one or stored in bundles. This is enough for the needs of the demo app.
            'file_path' => $this->kernelRootDir.'/Resources/views/'.$template->getTemplateName(),
            'starting_line' => 1,
            'source_code' => $template->getSource(),
        );
    }

    /**
     * Utility method that "unindents" the given $code when all its lines start
     * with a tabulation of four white spaces.
     *
     * @param  string $code
     *
     * @return string
     */
    private function unindentCode($code)
    {
        $formattedCode = $code;
        $codeLines = explode("\n", $code);

        $indentedLines = array_filter($codeLines, function ($lineOfCode) {
            return '' === $lineOfCode || '    ' === substr($lineOfCode, 0, 4);
        });

        if (count($indentedLines) === count($codeLines)) {
            $formattedCode = array_map(function ($lineOfCode) { return substr($lineOfCode, 4); }, $codeLines);
            $formattedCode = implode("\n", $formattedCode);
        }

        return $formattedCode;
    }

    // the name of the Twig extension must be unique in the application
    public function getName()
    {
        return 'code_explorer_source_code';
    }
}
