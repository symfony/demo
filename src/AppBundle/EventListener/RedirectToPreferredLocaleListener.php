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
     * @var string
     */
    private $defaultLocale = '';

    /**
     * Constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     * @param string $locales Supported locales separated by '|'
     * @param string|null $defaultLocale
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, $locales, $defaultLocale = null)
    {
        $this->locales = explode('|', trim($locales));

        if (empty($this->locales)) {
            throw new \UnexpectedValueException('Locales argument value must not be empty');
        }

        $this->defaultLocale = $defaultLocale;

        if (null === $this->defaultLocale) {
            $this->defaultLocale = $this->locales[0];
        } elseif (!in_array($this->defaultLocale, $this->locales)) {
            throw new \UnexpectedValueException(sprintf('The default locale\'s argument value "%s" must be one of "%s"', $this->defaultLocale, $locales));
        } else {
            // Add the default locale at the first position of an array,
            // because Symfony\HttpFoundation\Request::getPreferredLanguage
            // returns the first element of locales when no an appropriate language found
            $this->locales = array_unique(array_merge(array($this->defaultLocale), $this->locales));
        }

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

        // Ignores sub-requests and all routes but the homepage one
        if (!$event->isMasterRequest() || '/' !== $request->getPathInfo()) {
            return;
        }

        $preferredLanguage = $request->getPreferredLanguage($this->locales);

        if ($preferredLanguage !== $this->defaultLocale) {
            $response = new RedirectResponse($this->urlGenerator->generate('homepage', array('_locale' => $preferredLanguage)));
            $event->setResponse($response);
        }
    }
}
