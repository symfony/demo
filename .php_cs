#!/usr/bin/env php
<?php

$finder = PhpCsFixer\Finder::create()
    ->files()
    ->name('*.php')
    ->name('*.twig')
    ->in('app/Resources')
    ->in('src')
    ->append([
        'web/app.php',
        'web/app_dev.php',
    ])
;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'php_unit_strict' => true,
        'strict_comparison' => true,
    ])
    ->setFinder($finder)
;
