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
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Unit test for the event listener
 *
 * See http://symfony.com/doc/current/book/testing.html#unit-tests
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class CommentNotificationListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testOnCommentCreated()
    {
        $mailerProphecy = $this->prophesize(\Swift_Mailer::class);
        $urlGeneratorProphecy = $this->prophesize(UrlGeneratorInterface::class);
        $translatorProphecy = $this->prophesize(TranslatorInterface::class);

        $userProphecy = $this->prophesize(User::class);
        $userProphecy->getEmail('fabien@symfony.com');

        $postProphecy = $this->prophesize(Post::class);
        $postProphecy->getTitle()->willReturn('bar foo');
        $postProphecy->getAuthor()->willReturn('fabien');
        $postProphecy->getSlug()->willReturn('bar-foo');
        $postProphecy->getAuthor()->willReturn($userProphecy->reveal());

        $commentProphecy = $this->prophesize(Comment::class);
        $commentProphecy->getId()->willReturn(241);
        $commentProphecy->getPost()->willReturn($postProphecy->reveal());

        $event = new GenericEvent($commentProphecy->reveal());

        $urlGeneratorProphecy->generate('blog_post', ['slug' => 'bar-foo', '_fragment' => 'comment_241'], 0)->willReturn('http://foo.sf')->shouldBeCalled();
        $translatorProphecy->trans("notification.comment_created")->shouldBeCalled();
        $translatorProphecy->trans("notification.comment_created.description", ["%title%" => "bar foo", "%link%" => "http://foo.sf"])->shouldBeCalled();

        $listener = new CommentNotificationListener($mailerProphecy->reveal(), $urlGeneratorProphecy->reveal(), $translatorProphecy->reveal(), 'foo@bar.sf');
        $listener->onCommentCreated($event);
    }
}
