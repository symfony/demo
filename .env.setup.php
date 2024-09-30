<?php

$env = file_get_contents('.env');

if (!preg_match('{^APP_SECRET=("?)%generate\(secret\)%\1([\r\n]++)}m', $env, $m)) {
    return;
}

$eol = $m[2];
$local = is_file('.env.local') ? file_get_contents('.env.local') : '';

if (preg_match('{^APP_SECRET=}m', $local)) {
    return;
}

file_put_contents('.env.local', 'APP_SECRET="'.bin2hex(random_bytes(16)).'"'.$eol.$local);
