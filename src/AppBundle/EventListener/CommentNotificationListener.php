<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Notifies post's author about new comments.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class CommentNotificationListener
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var string
     */
    private $sender;

    /**
     * Constructor.
     *
     * @param \Swift_Mailer         $mailer
     * @param UrlGeneratorInterface $urlGenerator
     * @param TranslatorInterface   $translator
     * @param string                $sender
     */
    public function __construct(\Swift_Mailer $mailer, UrlGeneratorInterface $urlGenerator, TranslatorInterface $translator, $sender)
    {
        $this->mailer = $mailer;
        $this->urlGenerator = $urlGenerator;
        $this->translator = $translator;
        $this->sender = $sender;
    }

    /**
     * @param GenericEvent $event
     */
    public function onCommentCreated(GenericEvent $event)
    {
        $comment = $event->getSubject();
        $post = $comment->getPost();

        $linkToPost = $this->urlGenerator->generate('blog_post', ['slug' => $post->getSlug()], UrlGeneratorInterface::ABSOLUTE_URL);

        $subject = $this->translator->trans('post.recieved_comment');
        $body = $this->translator->trans('post.recieved_comment_message', [
            '%title%' => $post->getTitle(),
            '%link%' => $linkToPost.'#comment_'.$comment->getId(),
        ]);

        // See http://symfony.com/doc/current/email.html#sending-emails
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setTo($post->getAuthorEmail())
            ->setFrom($this->sender)
            ->setBody($body, 'text/html')
        ;

        // You can view a sent email in the debug toolbar
        // See http://symfony.com/doc/current/email/dev_environment.html#viewing-from-the-web-debug-toolbar
        $this->mailer->send($message);
    }
}
