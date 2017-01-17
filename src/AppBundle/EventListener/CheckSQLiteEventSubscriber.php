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

use Doctrine\DBAL\Exception\DriverException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleExceptionEvent;
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
class CheckSQLiteEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CheckSQLiteEventSubscriber constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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
            // See: http://api.symfony.com/3.2/Symfony/Component/HttpKernel/KernelEvents.html
            KernelEvents::EXCEPTION => 'onKernelException',
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
            if ($this->isSQLitePlatform() && !extension_loaded('sqlite3')) {
                $io = new SymfonyStyle($event->getInput(), $event->getOutput());
                $io->error('This command requires to have the "sqlite3" PHP extension enabled because, by default, the Symfony Demo application uses SQLite to store its information.');
            }
        }
    }

    /**
     * This method is triggered when kernel exception occurs. And checks if sqlite extension is enabled.
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        // Since any exception thrown during a Twig template rendering is wrapped in a Twig_Error_Runtime.
        // We must get the original exception.
        $previousException = $exception->getPrevious();

        // Driver exception may happen in controller or in twig template rendering
        $isDriverException = ($exception instanceof DriverException || $previousException instanceof DriverException);

        // Check if SQLite is enabled
        if ($isDriverException && $this->isSQLitePlatform() && !extension_loaded('sqlite3')) {
            $event->setException(new \Exception('PHP extension "sqlite3" must be enabled because, by default, the Symfony Demo application uses SQLite to store its information.'));
        }
    }

    /**
     * Check if demo application is configured to use SQLite as database.
     *
     * @return bool
     */
    private function isSQLitePlatform()
    {
        $databasePlatform = $this->entityManager->getConnection()->getDatabasePlatform();

        return $databasePlatform ? $databasePlatform->getName() === 'sqlite' : false;
    }
}
