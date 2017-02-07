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

use AppBundle\Entity\Comment;
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
        /** @var Comment $comment */
        $comment = $event->getSubject();
        $post = $comment->getPost();

        $linkToPost = $this->urlGenerator->generate('blog_post', [
            'slug' => $post->getSlug(),
            '_fragment' => 'comment_'.$comment->getId(),
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        $subject = $this->translator->trans('notification.comment_created');
        $body = $this->translator->trans('notification.comment_created.description', [
            '%title%' => $post->getTitle(),
            '%link%' => $linkToPost,
        ]);

        // Symfony uses a library called SwiftMailer to send emails. That's why
        // email messages are created instantiating a Swift_Message class.
        // See http://symfony.com/doc/current/email.html#sending-emails
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setTo($post->getAuthor()->getEmail())
            ->setFrom($this->sender)
            ->setBody($body, 'text/html')
        ;

        // In app/config/config_dev.yml the 'disable_delivery' option is set to 'true'.
        // That's why in the development environment you won't actually receive any email.
        // However, you can inspect the contents of those unsent emails using the debug toolbar.
        // See http://symfony.com/doc/current/email/dev_environment.html#viewing-from-the-web-debug-toolbar
        $this->mailer->send($message);
    }
}
