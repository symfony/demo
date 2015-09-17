<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

/**
 * This listener subscribes to the 'kernel.request' event to redirect a client
 * to an appropriate locale, according to browser settings.
 *
 * See http://symfony.com/doc/current/components/http_kernel/introduction.html#the-kernel-request-event
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class RedirectToPreferedLocaleListener
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * List of supported locales.
     *
     * @var array
     */
    private $locales = array();

    public function __construct($locales = '', RouterInterface $router)
    {
        $this->locales = explode('|', $locales);
        $this->router = $router;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ('/' !== $request->getPathInfo()) {
            return;
        }

        $preferedLanguage = $request->getPreferredLanguage($this->locales);

        if ('' !== $preferedLanguage && $request->getDefaultLocale() !== $preferedLanguage) {
            $response = new RedirectResponse($this->router->generate('homepage', array('_locale' => $preferedLanguage)));
            $event->setResponse($response);
        }
    }
}
