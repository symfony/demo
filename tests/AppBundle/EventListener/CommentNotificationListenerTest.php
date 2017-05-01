<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\AppBundle\EventListener;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Entity\User;
use AppBundle\EventListener\CommentNotificationListener;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Unit test for the event listener.
 *
 * See http://symfony.com/doc/current/book/testing.html#unit-tests
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 *
 * @author Michael COULLERET <michael.coulleret@gmail.com>
 */
class CommentNotificationListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testListenerOnCommentCreated()
    {
        $mailer = $this->prophesize(\Swift_Mailer::class);
        $urlGenerator = $this->prophesize(UrlGeneratorInterface::class);
        $translator = $this->prophesize(TranslatorInterface::class);

        $user = $this->prophesize(User::class);
        $user->getEmail('fabien@symfony.com');

        $post = $this->prophesize(Post::class);
        $post->getTitle()->willReturn('bar foo');
        $post->getAuthor()->willReturn('fabien');
        $post->getSlug()->willReturn('bar-foo');
        $post->getAuthor()->willReturn($user->reveal());

        $comment = $this->prophesize(Comment::class);
        $comment->getId()->willReturn(241);
        $comment->getPost()->willReturn($post->reveal());

        $event = new GenericEvent($comment->reveal());

        $urlGenerator->generate('blog_post', ['slug' => 'bar-foo', '_fragment' => 'comment_241'], 0)->willReturn('https://foo.sf')->shouldBeCalled();

        $translator->trans('notification.comment_created')->shouldBeCalled();
        $translator->trans('notification.comment_created.description', ['%title%' => 'bar foo', '%link%' => 'https://foo.sf'])->shouldBeCalled();

        $listener = new CommentNotificationListener($mailer->reveal(), $urlGenerator->reveal(), $translator->reveal(), 'foo@bar.sf');
        $listener->onCommentCreated($event);

        $mailer->send(Argument::type(\Swift_Message::class))->shouldBeCalled();
    }
}
