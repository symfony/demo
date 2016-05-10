<?php

/**
 * This file loads services into the Symfony Container dynamically. This allows
 * to check if the PHP Intl extension is loaded in the system. If it's loaded,
 * we use the default Twig Intl extension. If it's not loaded, we use a fallback
 * Twig extension which doesn't require the Intl extension.
 */

use Symfony\Component\DependencyInjection\Definition;

$serviceClass = extension_loaded('intl') ? 'Twig_Extensions_Extension_Intl' : 'AppBundle\\Twig\\IntlExtension';

$definition = new Definition($serviceClass);
$definition->setPublic(false);
$definition->addTag('twig.extension');
$container->setDefinition('app.twig.intl_extension', $definition);
