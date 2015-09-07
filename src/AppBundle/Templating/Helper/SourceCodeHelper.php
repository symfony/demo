<?php
/**
 * This file is part of the Symfony package.
 *
 * @copyright (c) 2015, symfony-demo
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Templating\Helper;

use ReflectionClass;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Templating\Helper\Helper;

/**
 * Class SourceCodeHelper
 *
 * @author Rasanga Perera <rasangaperera@gmail.com>
 */
class SourceCodeHelper extends Helper
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var string
     */
    private $kernelRootDir;

    /**
     * @param EngineInterface $templating
     * @param string $kernelRootDir
     */
    public function __construct(
        EngineInterface $templating,
        $kernelRootDir
    ) {
        $this->templating = $templating;
        $this->kernelRootDir = $kernelRootDir;
    }

    /**
     * @param string $templateName
     * @param string $templateSource
     * @param array|null $controller
     *
     * @return string
     */
    public function showSourceCode(
        $templateName,
        $templateSource,
        $controller = null
    ) {
        return $this->templating->render('default/_source_code.html.twig', array(
            'controller' => $this->getController($controller),
            'template'   => array(
                'file_path'     => $this->kernelRootDir.'/Resources/views/'.$templateName,
                'starting_line' => 1,
                'source_code'   => $templateSource,
            )
        ));
    }

    /**
     * @param array|null $controller
     *
     * @return array|void
     */
    private function getController($controller = null)
    {
        // this happens for example for exceptions (404 errors, etc.)
        if (null === $controller) {
            return;
        }

        $className = get_class($controller[0]);
        $class = new ReflectionClass($className);
        $method = $class->getMethod($controller[1]);

        $classCode = file($class->getFilename());
        $methodCode = array_slice($classCode, $method->getStartline() - 1, $method->getEndLine() - $method->getStartline() + 1);
        $controllerCode = '    '.$method->getDocComment()."\n".implode('', $methodCode);

        return array(
            'file_path'     => $class->getFilename(),
            'starting_line' => $method->getStartline(),
            'source_code'   => $this->unindentCode($controllerCode)
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

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'app_source_code';
    }
}
