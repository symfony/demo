<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\EventSubscriber;

use Doctrine\DBAL\Exception\DriverException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * This application uses by default an SQLite database to store its information.
 * That's why the 'sqlite3' extension must be enabled in PHP. This event
 * subscriber listens to console events and in case of an exception caused by
 * a disabled 'sqlite3' extension, it displays a meaningful error message.
 *
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class CheckRequirementsSubscriber implements EventSubscriberInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Event Subscribers must define this method to declare the events they
    // listen to. You can listen to several events, execute more than one method
    // for each event and set the priority of each event too.
    // See https://symfony.com/doc/current/event_dispatcher.html#creating-an-event-subscriber
    public static function getSubscribedEvents(): array
    {
        return [
            // Errors are one of the events defined by the Console. See the
            // rest here: https://symfony.com/doc/current/components/console/events.html
            ConsoleEvents::ERROR => 'handleConsoleError',
            // See: http://api.symfony.com/master/Symfony/Component/HttpKernel/KernelEvents.html
            KernelEvents::EXCEPTION => 'handleKernelException',
        ];
    }

    /**
     * This method checks if there has been an error in a command related to
     * the database and then, it checks if the 'sqlite3' PHP extension is enabled
     * or not to display a better error message.
     */
    public function handleConsoleError(ConsoleErrorEvent $event): void
    {
        $commandNames = ['doctrine:fixtures:load', 'doctrine:database:create', 'doctrine:schema:create', 'doctrine:database:drop'];

        if ($event->getCommand() && \in_array($event->getCommand()->getName(), $commandNames, true)) {
            if ($this->isSQLitePlatform() && !\extension_loaded('sqlite3')) {
                $io = new SymfonyStyle($event->getInput(), $event->getOutput());
                $io->error('This command requires to have the "sqlite3" PHP extension enabled because, by default, the Symfony Demo application uses SQLite to store its information.');
            }
        }
    }

    /**
     * This method checks if the triggered exception is related to the database
     * and then, it checks if the required 'sqlite3' PHP extension is enabled.
     */
    public function handleKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();
        // Since any exception thrown during a Twig template rendering is wrapped
        // in a Twig_Error_Runtime, we must get the original exception.
        $previousException = $exception->getPrevious();

        // Driver exception may happen in controller or in twig template rendering
        $isDriverException = ($exception instanceof DriverException || $previousException instanceof DriverException);

        // Check if SQLite is enabled
        if ($isDriverException && $this->isSQLitePlatform() && !\extension_loaded('sqlite3')) {
            $event->setException(new \Exception('PHP extension "sqlite3" must be enabled because, by default, the Symfony Demo application uses SQLite to store its information.'));
        }
    }

    /**
     * Checks if the application is using SQLite as its database.
     */
    private function isSQLitePlatform(): bool
    {
        $databasePlatform = $this->entityManager->getConnection()->getDatabasePlatform();

        return $databasePlatform ? 'sqlite' === $databasePlatform->getName() : false;
    }
}
