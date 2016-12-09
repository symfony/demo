#!/usr/bin/env php
<?php
return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => true,
        'phpdoc_order' => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
            ->exclude('app/config')
            ->exclude('app/data')
            ->exclude('app/Resources')
            ->exclude('var')
            ->exclude('vendor')
            ->exclude('web/bundles')
            ->exclude('web/css')
            ->exclude('web/fonts')
            ->exclude('web/js')
            ->notPath('web/config.php')
            ->in(__DIR__)
    )
;
