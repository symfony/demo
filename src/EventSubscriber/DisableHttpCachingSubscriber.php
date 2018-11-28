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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Disables HTTP caching.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class DisableHttpCachingSubscriber implements EventSubscriberInterface
{
    /**
     * @var bool
     */
    private $disableHttpCaching = false;

    public static function getSubscribedEvents(): array
    {
        return [
            // See https://symfony.com/doc/current/components/http_kernel.html#the-kernel-response-event
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    public function disableHttpCaching(): void
    {
        $this->disableHttpCaching = true;
    }

    public function onKernelResponse(FilterResponseEvent $event): void
    {
        if (!$event->isMasterRequest() || !$this->disableHttpCaching) {
            return;
        }

        // See https://tools.ietf.org/html/rfc7234#section-5.2.1.5
        $event->getResponse()->headers->addCacheControlDirective('no-store');
    }
}
