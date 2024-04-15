<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\EventSubscriber;

use App\Entity\Post;
use App\Entity\User;
use App\Event\CommentCreatedEvent;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Notifies post's author about new comments.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
final readonly class CommentNotificationSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private MailerInterface $mailer,
        private UrlGeneratorInterface $urlGenerator,
        private TranslatorInterface $translator,
        #[Autowire('%app.notifications.email_sender%')]
        private string $sender
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CommentCreatedEvent::class => 'onCommentCreated',
        ];
    }

    public function onCommentCreated(CommentCreatedEvent $event): void
    {
        $comment = $event->getComment();

        /** @var Post $post */
        $post = $comment->getPost();

        /** @var User $author */
        $author = $post->getAuthor();

        /** @var string $emailAddress */
        $emailAddress = $author->getEmail();

        $linkToPost = $this->urlGenerator->generate('blog_post', [
            'slug' => $post->getSlug(),
            '_fragment' => 'comment_'.$comment->getId(),
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        $subject = $this->translator->trans('notification.comment_created');

        $body = $this->translator->trans('notification.comment_created.description', [
            'title' => $post->getTitle(),
            'link' => $linkToPost,
        ]);

        // See https://symfony.com/doc/current/mailer.html
        $email = (new Email())
            ->from($this->sender)
            ->to($emailAddress)
            ->subject($subject)
            ->html($body)
        ;

        // In config/packages/mailer.yaml the delivery of messages is disabled in the development environment.
        // That's why you won't actually receive any email.
        // However, you can inspect the contents of those unsent emails using the debug toolbar.
        $this->mailer->send($email);
    }
}
