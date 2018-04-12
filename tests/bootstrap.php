<?php
require_once __DIR__.'/../vendor/autoload.php';

use App\Kernel;
use Symfony\Component\Console\Input\ArrayInput;

$kernel = new Kernel('test', true);
$kernel->boot();
$application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
$application->setAutoExit(false);
$application->run(new \Symfony\Component\Console\Input\ArrayInput([
    'command' => 'doctrine:database:drop',
    '--if-exists' => '1',
    '--force' => '1',
    '-q' => '1',
]));
$application->run(new \Symfony\Component\Console\Input\ArrayInput([
    'command' => 'doctrine:database:create',
    '-q' => '1',
]));
$application->run(new ArrayInput([
    'command' => 'doctrine:migrations:migrate',
    '--no-interaction' => '1',
    '-q' => '1',
]));
$kernel->shutdown();
