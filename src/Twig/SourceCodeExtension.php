<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\ErrorHandler\ErrorRenderer\FileLinkFormatter;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TemplateWrapper;
use Twig\TwigFunction;
use function Symfony\Component\String\u;

/**
 * CAUTION: this is an extremely advanced Twig extension. It's used to get the
 * source code of the controller and the template used to render the current
 * page. If you are starting with Symfony, don't look at this code and consider
 * studying instead the code of the src/Twig/AppExtension.php extension.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
final class SourceCodeExtension extends AbstractExtension
{
    /**
     * @var callable|null
     */
    private $controller;

    public function __construct(
        private readonly FileLinkFormatter $fileLinkFormat,
        #[Autowire('%kernel.project_dir%')]
        private string $projectDir,
    ) {
        $this->projectDir = str_replace('\\', '/', $projectDir).'/';
    }

    public function setController(?callable $controller): void
    {
        $this->controller = $controller;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('link_source_file', $this->linkSourceFile(...), ['is_safe' => ['html'], 'needs_environment' => true]),
            new TwigFunction('show_source_code', $this->showSourceCode(...), ['is_safe' => ['html'], 'needs_environment' => true]),
        ];
    }

    /**
     * Render a link to a source file.
     */
    public function linkSourceFile(Environment $twig, string $file, int $line): string
    {
        $text = str_replace('\\', '/', $file);

        if (str_starts_with($text, $this->projectDir)) {
            $text = mb_substr($text, mb_strlen($this->projectDir));
        }

        if (false === $link = $this->fileLinkFormat->format($file, $line)) {
            return '';
        }

        return \sprintf('<a href="%s" title="Click to open this file" class="file_link">%s</a> at line %d',
            htmlspecialchars($link, \ENT_COMPAT | \ENT_SUBSTITUTE, $twig->getCharset()),
            htmlspecialchars($text, \ENT_COMPAT | \ENT_SUBSTITUTE, $twig->getCharset()),
            $line,
        );
    }

    public function showSourceCode(Environment $twig, string|TemplateWrapper $template): string
    {
        return $twig->render('debug/source_code.html.twig', [
            'controller' => $this->getController(),
            'template' => $this->getTemplateSource($twig->resolveTemplate($template)),
        ]);
    }

    /**
     * @return array{file_path: string, starting_line: int|false, source_code: string}|null
     */
    private function getController(): ?array
    {
        // this happens for example for exceptions (404 errors, etc.)
        if (null === $this->controller) {
            return null;
        }

        $method = $this->getCallableReflector($this->controller);

        /** @var string $fileName */
        $fileName = $method->getFileName();

        if (false === $classCode = file($fileName)) {
            throw new \LogicException(\sprintf('There was an error while trying to read the contents of the "%s" file.', $fileName));
        }

        $startLine = $method->getStartLine() - 1;
        $endLine = $method->getEndLine();

        while ($startLine > 0) {
            $line = trim($classCode[$startLine - 1]);

            if (\in_array($line, ['{', '}', ''], true)) {
                break;
            }

            --$startLine;
        }

        $controllerCode = implode('', \array_slice($classCode, $startLine, $endLine - $startLine));

        return [
            'file_path' => $fileName,
            'starting_line' => $method->getStartLine(),
            'source_code' => $this->unindentCode($controllerCode),
        ];
    }

    /**
     * Gets a reflector for a callable.
     *
     * This logic is copied from Symfony\Component\HttpKernel\Controller\ControllerResolver::getArguments
     */
    private function getCallableReflector(callable $callable): \ReflectionFunctionAbstract
    {
        if (\is_array($callable)) {
            return new \ReflectionMethod($callable[0], $callable[1]);
        }

        if (\is_object($callable) && !$callable instanceof \Closure) {
            $r = new \ReflectionObject($callable);

            return $r->getMethod('__invoke');
        }

        return new \ReflectionFunction($callable);
    }

    /**
     * @return array{file_path: string|false, starting_line: int, source_code: string}
     */
    private function getTemplateSource(TemplateWrapper $template): array
    {
        $templateSource = $template->getSourceContext();

        return [
            // Twig templates are not always stored in files (they can be stored
            // in a database for example). However, for the needs of the Symfony
            // Demo app, we consider that all templates are stored in files and
            // that their file paths can be obtained through the source context.
            'file_path' => $templateSource->getPath(),
            'starting_line' => 1,
            'source_code' => $templateSource->getCode(),
        ];
    }

    /**
     * Utility method that "unindents" the given $code when all its lines start
     * with a tabulation of four white spaces.
     */
    private function unindentCode(string $code): string
    {
        $codeLines = u($code)->split("\n");

        $indentedOrBlankLines = array_filter($codeLines, static function ($lineOfCode) {
            return u($lineOfCode)->isEmpty() || u($lineOfCode)->startsWith('    ');
        });

        $codeIsIndented = \count($indentedOrBlankLines) === \count($codeLines);

        if ($codeIsIndented) {
            $unindentedLines = array_map(static function ($lineOfCode) {
                return u($lineOfCode)->after('    ');
            }, $codeLines);
            $code = u("\n")->join($unindentedLines)->toString();
        }

        return $code;
    }
}
