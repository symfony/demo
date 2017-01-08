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

/**
 * This application uses by default an SQLite database to store its information.
 * That's why the 'sqlite3' extension must be enabled in PHP. This event
 * subscriber listens to console events and in case of an exception caused by
 * a disabled 'sqlite3' extension, it displays a meaningful error message.
 *
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class ConsoleEventSubscriber implements EventSubscriberInterface
{
    // Event Subscribers must define this method to declare the events they
    // listen to. You can listen to several events, execute more than one method
    // for each event and set the priority of each event too.
    // See http://symfony.com/doc/current/event_dispatcher.html#creating-an-event-subscriber
    public static function getSubscribedEvents()
    {
        return [
            // Exceptions are one of the events defined by the Console. See the
            // rest here: http://symfony.com/doc/current/components/console/events.html
            ConsoleEvents::EXCEPTION => 'handleDatabaseExceptions',
        ];
    }

    /**
     * This method checks if there has been an exception in a command related to
     * the database and then, it checks if the 'sqlite3' PHP extension is enabled
     * or not to display a better error message.
     *
     * @param ConsoleExceptionEvent $event
     */
    public function handleDatabaseExceptions(ConsoleExceptionEvent $event)
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
