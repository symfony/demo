<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;

use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleExceptionEvent;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ConsoleEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            ConsoleEvents::EXCEPTION => 'displayBetterErrorMessages',
        ];
    }

    public function displayBetterErrorMessages(ConsoleExceptionEvent $event)
    {
        $commandNames = ['doctrine:fixtures:load', 'doctrine:database:create', 'doctrine:schema:create', 'doctrine:database:drop'];

        if (in_array($event->getCommand()->getName(), $commandNames)) {
            if (!extension_loaded('sqlite3')) {
                $io = new SymfonyStyle($event->getInput(), $event->getOutput());
                $io->error('This command requires to have the "sqlite3" PHP extension enabled because, by default, the Symfony Demo application uses SQLite to store its information.');
            }
        }
    }
}
