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

use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig_Extension;
use Twig_LoaderInterface;
use Twig_SimpleFunction;
use Twig_Template;

/**
 * CAUTION: this is an extremely advanced Twig extension. It's used to get the
 * source code of the controller and the template used to render the current
 * page. If you are starting with Symfony, don't look at this code and consider
 * studying instead the code of the src/AppBundle/Twig/AppExtension.php extension.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class SourceCodeExtension extends Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Twig_LoaderInterface
     */
    private $loader;

    /**
     * @var string
     */
    private $kernelRootDir;

    /**
     * @var array|null
     */
    private $controller;

    /**
     * @param ContainerInterface $container
     * @param Twig_LoaderInterface $loader
     * @param $kernelRootDir
     */
    public function __construct(
        ContainerInterface $container,
        Twig_LoaderInterface $loader,
        $kernelRootDir
    ) {
        $this->container = $container;
        $this->kernelRootDir = $kernelRootDir;
        $this->loader = $loader;
    }

    /**
     * @param array|null $controller
     */
    public function setController($controller = null)
    {
        $this->controller = $controller;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('show_source_code', array($this, 'showSourceCode'), array(
                'is_safe' => array('html')
            )),
        );
    }

    /**
     * @param Twig_Template $template
     *
     * @return string
     */
    public function showSourceCode(Twig_Template $template)
    {
        $templateName = $template->getTemplateName();

        return $this->container->get('app.templating.source_code_helper')->showSourceCode(
            $templateName,
            $this->loader->getSource($templateName),
            $this->controller
        );
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        // the name of the Twig extension must be unique in the application
        return 'app.source_code_extension';
    }
}
