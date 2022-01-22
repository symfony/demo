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

use App\Twig\SourceCodeExtension;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Defines the method that 'listens' to the 'kernel.controller' event, which is
 * triggered whenever a controller is executed in the application.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class ControllerSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private SourceCodeExtension $twigExtension
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'registerCurrentController',
        ];
    }

    public function registerCurrentController(ControllerEvent $event): void
    {
        // this check is needed because in Symfony a request can perform any
        // number of sub-requests. See
        // https://symfony.com/doc/current/components/http_kernel.html#sub-requests
        if ($event->isMainRequest()) {
            $this->twigExtension->setController($event->getController());
        }
    }
}
