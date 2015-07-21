<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Twig;

use Symfony\Component\Intl\Intl;

/**
 * @author Julien ITARD <julienitard@gmail.com>
 */
class LocaleExtension extends \Twig_Extension
{
    private $locales;

    public function __construct( $locales)
    {
        $this->locales = $locales;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('locales', array($this, 'getLocales')),
        );
    }

    public function getLocales()
    {
        $array = explode('|', $this->locales);

        foreach ($array as $locale) {
            $locales[] = array('code' => $locale, 'name' => Intl::getLocaleBundle()->getLocaleName($locale, $locale));
        }

        return $locales; 
    }

    // the name of the Twig extension must be unique in the application
    public function getName()
    {
        return 'app.locale_extension';
    }
}
