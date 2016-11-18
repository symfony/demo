<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * This class is the one that transforms the src/AppBundle/ directory into a real
 * Symfony bundle.
 *
 * There are two types of bundles:
 *
 *   * Reusable Bundles: they are meant to be shared between different applications.
 *     A lot of them are even publicly available in sites like packagist.org.
 *     See http://symfony.com/doc/current/cookbook/bundles/best_practices.html
 *   * Application bundles: they are never shared, not even with other of your
 *     applications. This allows them to be less strict in some conventions and
 *     their code is usually simpler.
 *     See http://symfony.com/doc/current/best_practices/business-logic.html
 *
 * The AppBundle is an application bundle that is already created when you install
 * Symfony. Using AppBundle to start developing your Symfony application is
 * considered a good practice, but you can also split your application code into
 * as many bundles as you want.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class AppBundle extends Bundle
{
    // At first it's common to leave this class empty, but when the application grows,
    // you may need to add some initialization code in the boot() method.
    // Checkout the Symfony\Component\HttpKernel\Bundle\Bundle class to see all
    // the available methods for bundles.
}
