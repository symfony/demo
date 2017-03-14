<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests;

/**
 * Helper class to create users clients.
 */
trait ControllerTestTrait
{
    /**
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    private function getAdminClient()
    {
        return self::createClient([], [
            'PHP_AUTH_USER' => 'jane_admin',
            'PHP_AUTH_PW' => 'kitten',
        ]);
    }

    /**
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    private function getUserClient()
    {
        return self::createClient([], [
            'PHP_AUTH_USER' => 'john_user',
            'PHP_AUTH_PW' => 'kitten',
        ]);
    }

    /**
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    private function getAnonymousClient()
    {
        return self::createClient();
    }
}
