#!/usr/bin/env php
<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('vendor')
    ->notPath('web/config.php')
    // Doctrine fixtures are excluded to avoid these PHP-CS-Fixer errors:
    // "Files were not fixed due to errors reported during linting before fixing"
    ->notPath('DataFixtures')
;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder)
;
