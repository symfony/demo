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
use Doctrine\Bundle\DoctrineBundle\Registry;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional test that implements a "smoke test" of all the public and secure
 * URLs of the application.
 * See https://symfony.com/doc/current/best_practices.html#smoke-test-your-urls.
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
final class DefaultControllerTest extends WebTestCase
{
    /**
     * PHPUnit's data providers allow to execute the same tests repeated times
     * using a different set of data each time.
     * See https://symfony.com/doc/current/testing.html#testing-against-different-sets-of-data.
     */
    #[DataProvider('getPublicUrls')]
    public function testPublicUrls(string $url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful(\sprintf('The %s public URL loads correctly.', $url));
    }

    /**
     * A good practice for tests is to not use the service container, to make
     * them more robust. However, in this example we must access to the container
     * to get the entity manager and make a database query. The reason is that
     * blog post fixtures are randomly generated and there's no guarantee that
     * a given blog post slug will be available.
     */
    public function testPublicBlogPost(): void
    {
        $client = static::createClient();

        // the service container is always available via the test client
        /** @var Registry $registry */
        $registry = $client->getContainer()->get('doctrine');

        /** @var Post $blogPost */
        $blogPost = $registry->getRepository(Post::class)->find(1);

        $client->request('GET', \sprintf('/en/blog/posts/%s', $blogPost->getSlug()));
        $this->assertResponseIsSuccessful();
    }

    /**
     * The application contains a lot of secure URLs which shouldn't be
     * publicly accessible. This tests ensures that whenever a user tries to
     * access one of those pages, a redirection to the login form is performed.
     */
    #[DataProvider('getSecureUrls')]
    public function testSecureUrls(string $url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertResponseRedirects(
            'http://localhost/en/login',
            Response::HTTP_FOUND,
            \sprintf('The %s secure URL redirects to the login form.', $url)
        );
    }

    public static function getPublicUrls(): \Generator
    {
        yield ['/'];
        yield ['/en/blog/'];
        yield ['/en/login'];
    }

    public static function getSecureUrls(): \Generator
    {
        yield ['/en/admin/post/'];
        yield ['/en/admin/post/new'];
        yield ['/en/admin/post/1'];
        yield ['/en/admin/post/1/edit'];
    }
}
