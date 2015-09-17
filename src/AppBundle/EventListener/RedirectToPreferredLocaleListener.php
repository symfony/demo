<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * This listener subscribes to the 'kernel.request' event to redirect a client
 * to an appropriate locale, according to browser settings.
 *
 * See http://symfony.com/doc/current/components/http_kernel/introduction.html#the-kernel-request-event
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class RedirectToPreferredLocaleListener
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * List of supported locales.
     *
     * @var string[]
     */
    private $locales = array();

    /**
     * Constructor.
     *
     * @param string $locales Supported locales separated by '|'
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct($locales = '', UrlGeneratorInterface $urlGenerator)
    {
        $this->locales = explode('|', $locales);
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Handles an event.
     *
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ('/' !== $request->getPathInfo()) {
            return;
        }

        $preferredLanguage = $request->getPreferredLanguage($this->locales);

        if ('' !== $preferredLanguage && $request->getDefaultLocale() !== $preferredLanguage) {
            $response = new RedirectResponse($this->urlGenerator->generate('homepage', array('_locale' => $preferredLanguage)));
            $event->setResponse($response);
        }
    }
}
