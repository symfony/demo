#!/usr/bin/env php
<?php

$finder = Symfony\CS\Finder::create()
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
;

return Symfony\CS\Config::create()
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers([
        '-psr0', // Ignore Tests\ namespace prefix mismatch with tests/ directory
        'ordered_use',
        'phpdoc_order',
        'short_array_syntax',
    ])
    ->finder($finder)
;
