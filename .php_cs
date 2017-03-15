#!/usr/bin/env php
<?php

$fileHeaderComment = <<<COMMENT
This file is part of the Symfony package.

(c) Fabien Potencier <fabien@symfony.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
COMMENT;

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('web/bundles')
    ->exclude('web/css')
    ->exclude('web/fonts')
    ->exclude('web/js')
    ->notPath('web/config.php')
;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'header_comment' => ['header' => $fileHeaderComment, 'separate' => 'both'],
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'php_unit_strict' => true,
        'strict_comparison' => true,
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__.'/var/.php_cs.cache')
;
