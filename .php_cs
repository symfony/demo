#!/usr/bin/env php
<?php

$finder = Symfony\CS\Finder::create()
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
    ->exclude('app')
    ->exclude('var')
    ->exclude('vendor')
    ->exclude('web')
    ->in(__DIR__)
;

return Symfony\CS\Config::create()
    ->fixers(['-psr0']) // Ignore Tests\ namespace prefix mismatch with tests/ directory
    ->finder($finder)
;
