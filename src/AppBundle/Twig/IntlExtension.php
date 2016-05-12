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

/**
 * This Twig extension adds a new 'localizeddate' filter to format date/time
 * objects. These formats are for English language only because this extension
 * is exclusively used when the system doesn't have the PHP Intl extension loaded.
 *
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class IntlExtension extends \Twig_Extension
{
    private $dateFormats = array(
        'full' => 'l, F d, Y',
        'long' => 'F d, Y',
        'medium' => 'M d, Y',
        'short' => 'M/d/yy',
        'none' => '',
    );

    private $timeFormats = array(
        'full' => 'r',
        'long' => 'h:i:s a e',
        'medium' => 'h:i:s a',
        'short' => 'h:i a',
        'none' => '',
    );

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('localizeddate', array($this, 'getLocalizedDate')),
        );
    }

    /**
     * Formats the given date string/object according to some predefined
     * date/time formats.
     *
     * @param  mixed $date
     * @param  string $dateFormat
     * @param  string $timeFormat
     *
     * @return string
     */
    public function getLocalizedDate($date, $dateFormat = 'medium', $timeFormat = 'medium')
    {
        $date = ($date instanceof \DateTimeInterface) ? $date : new \DateTime($date);

        return $date->format($this->dateFormats[$dateFormat].' '.$this->timeFormats[$timeFormat]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        // the name of the Twig extension must be unique in the application
        return 'app.intl_extension';
    }
}
