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

use AppBundle\Utils\Markdown;

/**
 * This Twig extension adds a new 'md2html' filter to easily transform Markdown
 * contents into HTML contents inside Twig templates.
 * See http://symfony.com/doc/current/cookbook/templating/twig_extension.html
 *
 * In addition to creating the Twig extension class, before using it you must also
 * register it as a service. See app/config/services.yml file for details.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class AppExtension extends \Twig_Extension
{
    private $parser;

    public function __construct(Markdown $parser)
    {
        $this->parser = $parser;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('md2html', array($this, 'markdownToHtml'), array('is_safe' => array('html'))),
        );
    }

    public function markdownToHtml($content)
    {
        return $this->parser->toHtml($content);
    }

    // the name of the Twig extension must be unique in the application. Consider
    // using 'app.extension' if you only have one Twig extension in your application.
    public function getName()
    {
        return 'app.extension';
    }
}
