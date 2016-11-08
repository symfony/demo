#!/usr/bin/env php
<?php

$finder = Symfony\CS\Finder::create()
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
    ->exclude('app/Resources')
    ->exclude('app/config')
    ->exclude('app/data')
    ->exclude('var')
    ->exclude('vendor')
    ->exclude('web/bundles')
    ->exclude('web/css')
    ->exclude('web/fonts')
    ->exclude('web/js')
    ->in(__DIR__)
;

return Symfony\CS\Config::create()
    ->fixers(['-psr0']) // Ignore Tests\ namespace prefix mismatch with tests/ directory
    ->finder($finder)
;
