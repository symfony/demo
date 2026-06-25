<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$fileHeaderComment = <<<COMMENT
    This file is part of the Symfony package.

    (c) Fabien Potencier <fabien@symfony.com>

    For the full copyright and license information, please view the LICENSE
    file that was distributed with this source code.
    COMMENT;

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests')
    ->exclude('var')
    ->notPath([
        'config/bundles.php',
        'config/reference.php',
    ])
;

return new PhpCsFixer\Config()
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP8x4Migration' => true,
        '@PHP8x4Migration:risky' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'declare_strict_types' => false, // depends how project wants to handle type matching and untaint user input
        'header_comment' => ['header' => $fileHeaderComment, 'separate' => 'both'],
        'no_useless_else' => true,
        'no_useless_return' => true,
        'php_unit_strict' => true,
        'strict_comparison' => true,
        'strict_param' => true,
    ])
    ->setCacheFile(__DIR__.'/var/.php-cs-fixer.cache')
;
