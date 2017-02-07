<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional test for the controllers defined inside the BlogController used
 * for managing the blog in the backend.
 *
 * See http://symfony.com/doc/current/book/testing.html#functional-tests
 *
 * Whenever you test resources protected by a firewall, consider using the
 * technique explained in:
 * http://symfony.com/doc/current/cookbook/testing/http_authentication.html
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class BlogControllerTest extends WebTestCase
{
    /**
     * @dataProvider getUrlsForRegularUsers
     */
    public function testRegularUsers($httpMethod, $url, $statusCode)
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'john_user',
            'PHP_AUTH_PW' => 'kitten',
        ]);

        $client->request($httpMethod, $url);
        $this->assertSame($statusCode, $client->getResponse()->getStatusCode());
    }

    public function getUrlsForRegularUsers()
    {
        yield ['GET', '/en/admin/post/', Response::HTTP_FORBIDDEN];
        yield ['GET', '/en/admin/post/1', Response::HTTP_FORBIDDEN];
        yield ['GET', '/en/admin/post/1/edit', Response::HTTP_FORBIDDEN];
        yield ['POST', '/en/admin/post/1/delete', Response::HTTP_FORBIDDEN];
    }

    /**
     * @dataProvider getUrlsForAdminUsers
     */
    public function testAdminUsers($httpMethod, $url, $statusCode)
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'anna_admin',
            'PHP_AUTH_PW' => 'kitten',
        ]);

        $client->request($httpMethod, $url);
        $this->assertSame($statusCode, $client->getResponse()->getStatusCode());
    }

    public function getUrlsForAdminUsers()
    {
        yield ['GET', '/en/admin/post/', Response::HTTP_OK];
        yield ['GET', '/en/admin/post/1', Response::HTTP_OK];
        yield ['GET', '/en/admin/post/1/edit', Response::HTTP_OK];
        yield ['POST', '/en/admin/post/1/delete', Response::HTTP_FOUND];
    }

    public function testBackendHomepage()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'anna_admin',
            'PHP_AUTH_PW' => 'kitten',
        ]);

        $crawler = $client->request('GET', '/en/admin/post/');

        $this->assertCount(
            30,
            $crawler->filter('body#admin_post_index #main tbody tr'),
            'The backend homepage displays all the available posts.'
        );
    }
}
