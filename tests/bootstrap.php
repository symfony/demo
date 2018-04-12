<?php
require_once __DIR__.'/../vendor/autoload.php';

use App\Kernel;
use Doctrine\Bundle\MigrationsBundle\Command\MigrationsMigrateDoctrineCommand;
use Symfony\Component\Console\Input\ArrayInput;

$kernel = new Kernel('test', true);
$kernel->boot();
$application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
$application->setAutoExit(false);
$application->add(new \Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand());
$application->add(new \Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand());
$application->add(new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\RunSqlDoctrineCommand());
$application->add(new MigrationsMigrateDoctrineCommand());
$application->run(new \Symfony\Component\Console\Input\ArrayInput([
    'command' => 'doctrine:database:drop',
    '--if-exists' => '1',
    '--force' => '1',
]));
$application->run(new \Symfony\Component\Console\Input\ArrayInput([
    'command' => 'doctrine:database:create',
]));
$application->run(new ArrayInput([
    'command' => 'doctrine:migrations:migrate',
    '--no-interaction' => '1',
    '--quiet' => '1'
]));
$kernel->shutdown();
