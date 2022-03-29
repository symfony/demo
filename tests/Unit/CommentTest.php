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

class CommentTest extends TestCase
{
    private Comment $comment;

    protected function setUp(): void
    {
        parent::setUp();
        $this->comment = new Comment();
    }

    public function testGetContent(): void
    {
        $content = 'Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua';
        $this->assertEmpty($this->comment->getContent());
        $this->comment->setContent($content);
        self::assertSame($content, $this->comment->getContent());
    }

    public function testGetAuthor(): void
    {
        $user = new User();
        $this->assertEmpty($this->comment->getAuthor());
        $this->comment->setAuthor($user);
        self::assertInstanceOf(User::class, $this->comment->getAuthor());
    }

    public function testGetPost(): void
    {
        $post = new Post();
        $this->assertEmpty($post->getComments());
        $post->addComment($this->comment);
        self::assertContains($this->comment, $post->getComments());
    }
}
