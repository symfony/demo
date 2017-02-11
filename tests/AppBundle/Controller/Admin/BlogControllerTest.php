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

use AppBundle\Entity\Post;
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
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    private function getAdminClient()
    {
        return static::createClient([], [
            'PHP_AUTH_USER' => 'jane_admin',
            'PHP_AUTH_PW' => 'kitten',
        ]);
    }

    public function testAdminBackendHomePage()
    {
        $client = $this->getAdminClient();

        $crawler = $client->request('GET', '/en/admin/post/');
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $this->assertCount(
            30,
            $crawler->filter('body#admin_post_index #main tbody tr'),
            'The backend homepage displays all the available posts.'
        );
    }

    public function testAdminDeletePost()
    {
        $client = $this->getAdminClient();

        $crawler = $client->request('GET', '/en/admin/post/1');

        $client->submit($crawler->filter('form')->form());

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $post = $client->getContainer()->get('doctrine')->getRepository(Post::class)->find(1);
        $this->assertNull($post);
    }

    public function testAdminEditPost()
    {
        $client = $this->getAdminClient();

        $crawler = $client->request('GET', '/en/admin/post/1/edit');

        $newTitle = 'what a nice new title!';

        $form = $crawler->filter('form')->form([
            'post[title]' => $newTitle,
        ]);

        $client->submit($form);

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        /** @var Post $post */
        $post = $client->getContainer()->get('doctrine')->getRepository(Post::class)->find(1);
        $this->assertSame($newTitle, $post->getTitle());
    }
}
