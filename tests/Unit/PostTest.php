<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    private Post $article;

    protected function setUp(): void
    {
        parent::setUp();
        $this->article = new Post();
    }

    public function testGetTitle(): void
    {
        $title = 'Lorem ipsum dolor sit amet consectetur adipiscing elit';
        $this->assertEmpty($this->article->getTitle());
        $this->article->setTitle($title);
        self::assertSame($title, $this->article->getTitle());
    }

    public function testGetSlug(): void
    {
        $slug = 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit';
        $this->assertEmpty($this->article->getSlug());
        $this->article->setSlug($slug);
        self::assertSame($slug, $this->article->getSlug());
    }

    public function testGetContent(): void
    {
        $content = 'Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua';
        $this->assertEmpty($this->article->getContent());
        $this->article->setContent($content);
        self::assertSame($content, $this->article->getContent());
    }

    public function testGetAuthor(): void
    {
        $user = new User();
        $this->assertEmpty($this->article->getAuthor());
        $this->article->setAuthor($user);
        self::assertInstanceOf(User::class, $this->article->getAuthor());
    }

    public function testGetComments(): void
    {
        $comment = new Comment();
        $this->assertEmpty($this->article->getComments());
        $this->article->addComment($comment);
        self::assertContains($comment, $this->article->getComments());
        $this->article->removeComment($comment);
        $this->assertEmpty($this->article->getComments());
    }
}
