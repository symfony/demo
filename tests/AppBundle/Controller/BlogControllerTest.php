<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\AppBundle\Controller;

use AppBundle\DataFixtures\FixturesTrait;
use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional test for the controllers defined inside BlogController.
 *
 * See http://symfony.com/doc/current/book/testing.html#functional-tests
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class BlogControllerTest extends WebTestCase
{
    use FixturesTrait;

    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/blog/');

        $this->assertCount(
            Post::NUM_ITEMS,
            $crawler->filter('article.post'),
            'The homepage displays the right number of posts.'
        );
    }

    public function testRss()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/blog/rss.xml');

        $this->assertSame(
            'text/xml; charset=UTF-8',
            $client->getResponse()->headers->get('Content-Type')
        );

        $this->assertCount(
            Post::NUM_ITEMS,
            $crawler->filter('item'),
            'The xml file displays the right number of posts.'
        );
    }

    /**
     * This test changes the database contents by creating a new comment. However,
     * thanks to the DAMADoctrineTestBundle and its PHPUnit listener, all changes
     * to the database are rolled back when this test completes. This means that
     * all the application tests begin with the same database contents.
     */
    public function testNewComment()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'john_user',
            'PHP_AUTH_PW' => 'kitten',
        ]);

        /** @var Post $post */
        $post = $client->getContainer()->get('doctrine')->getRepository(Post::class)->find(1);
        $commentContent = $this->getRandomCommentContent();
        $commentsCount = $post->getComments()->count();

        $crawler = $client->request('GET', '/en/blog/posts/'.$post->getSlug());
        $form = $crawler->selectButton('Publish comment')->form([
            'comment[content]' => $commentContent,
        ]);
        $client->submit($form);

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $post = $client->getContainer()->get('doctrine')->getRepository(Post::class)->find(1);
        // The first one is the most recent comment because of the automatic sorting
        // defined in the comments association of the Post entity
        $comment = $post->getComments()->first();

        $this->assertSame($commentsCount + 1, $post->getComments()->count());
        $this->assertSame($commentContent, $comment->getContent());
    }
}
