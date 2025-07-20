<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig;

use Symfony\Component\Intl\Locales;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * See https://symfony.com/doc/current/templating/twig_extension.html.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Julien ITARD <julienitard@gmail.com>
 */
final class AppExtension extends AbstractExtension
{
    /**
     * @var list<array{code: string, name: string}>|null
     */
    private ?array $locales = null;

    // The $locales argument is injected thanks to the service container.
    // See https://symfony.com/doc/current/service_container.html#binding-arguments-by-name-or-type
    public function __construct(
        /** @var string[] */
        private readonly array $enabledLocales,
        private readonly string $defaultLocale,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('locales', [$this, 'getLocales']),
            new TwigFunction('is_rtl', [$this, 'isRtl']),
            new TwigFunction('rtl_class', [$this, 'getRtlClass']),
            new TwigFunction('rtl_dir', [$this, 'getRtlDir']),
        ];
    }

    /**
     * Takes the list of codes of the locales (languages) enabled in the
     * application and returns an array with the name of each locale written
     * in its own language (e.g. English, Français, Español, etc.).
     *
     * @return array<int, array<string, string>>
     */
    public function getLocales(): array
    {
        if (null !== $this->locales) {
            return $this->locales;
        }

        $this->locales = [];

        foreach ($this->enabledLocales as $localeCode) {
            $this->locales[] = ['code' => $localeCode, 'name' => Locales::getName($localeCode, $localeCode)];
        }

        return $this->locales;
    }

    /**
     * Check if the given locale is RTL.
     */
    public function isRtl(?string $locale = null): bool
    {
        $locale = $locale ?? $this->defaultLocale;

        return \in_array($locale, ['ar', 'fa', 'he', 'ur', 'ps', 'sd'], true);
    }

    /**
     * Get RTL class if the locale is RTL.
     */
    public function getRtlClass(?string $locale = null): string
    {
        return $this->isRtl($locale) ? 'rtl' : '';
    }

    /**
     * Get direction attribute value for RTL support.
     */
    public function getRtlDir(?string $locale = null): string
    {
        return $this->isRtl($locale) ? 'rtl' : 'ltr';
    }
}
