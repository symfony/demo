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

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Kernel exception events allows to handle specific exceptions, or show custom response.
 *
 * See https://symfony.com/doc/current/controller/error_pages.html#use-kernel-exception-event
 *
 * On this kernel exception event, check if SQLite extension is enabled.
 * If not, show better error message. Instead of "could not find driver"
 */
class SQLiteExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if (!extension_loaded('sqlite3')) {
            $event->setException(new \Exception('PHP extension "sqlite3" must be enabled because, by default, the Symfony Demo application uses SQLite to store its information.'));
        }
    }
}