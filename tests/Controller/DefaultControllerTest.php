<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional test that implements a "smoke test" of all the public and secure
 * URLs of the application.
 * See https://symfony.com/doc/current/best_practices/tests.html#functional-tests.
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * PHPUnit's data providers allow to execute the same tests repeated times
     * using a different set of data each time.
     * See https://symfony.com/doc/current/cookbook/form/unit_testing.html#testing-against-different-sets-of-data.
     *
     * @dataProvider getPublicUrls
     */
    public function testPublicUrls(string $url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode(),
            sprintf('The %s public URL loads correctly.', $url)
        );
    }

    /**
     * A good practice for tests is to not use the service container, to make
     * them more robust. However, in this example we must access to the container
     * to get the entity manager and make a database query. The reason is that
     * blog post fixtures are randomly generated and there's no guarantee that
     * a given blog post slug will be available.
     */
    public function testPublicBlogPost()
    {
        $client = static::createClient();
        // the service container is always available via the test client
        $blogPost = $client->getContainer()->get('doctrine')->getRepository(Post::class)->find(1);
        $client->request('GET', sprintf('/en/blog/posts/%s', $blogPost->getSlug()));

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * The application contains a lot of secure URLs which shouldn't be
     * publicly accessible. This tests ensures that whenever a user tries to
     * access one of those pages, a redirection to the login form is performed.
     *
     * @dataProvider getSecureUrls
     */
    public function testSecureUrls(string $url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $response = $client->getResponse();
        $this->assertSame(Response::HTTP_FOUND, $response->getStatusCode());
        $this->assertSame(
            'http://localhost/en/login',
            $response->getTargetUrl(),
            sprintf('The %s secure URL redirects to the login form.', $url)
        );
    }

    public function getPublicUrls()
    {
        yield ['/'];
        yield ['/en/blog/'];
        yield ['/en/login'];
    }

    public function getSecureUrls()
    {
        yield ['/en/admin/post/'];
        yield ['/en/admin/post/new'];
        yield ['/en/admin/post/1'];
        yield ['/en/admin/post/1/edit'];
    }
}
