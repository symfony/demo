<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Entity\Post;

/**
 * Functional test for the DefaultController methods.
 * See http://symfony.com/doc/current/book/testing.html#functional-tests
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 * $ cd your-symfony-project/
 * $ phpunit -c app
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/blog/');

        $this->assertEquals(Post::NUM_ITEMS, $crawler->filter('article.post')->count(),
            'The homepage displayes the right number of posts'
        );
    }
}
