<?php


namespace App\EventSubscriber;


use App\Event\PostVisitedEvent;
use App\Service\PostViewCounter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostViewCounterSubscriber implements EventSubscriberInterface
{
    private $postViewCounter;

    public function __construct(PostViewCounter $postViewCounter)
    {
        $this->postViewCounter = $postViewCounter;
    }

    public static function getSubscribedEvents()
    {
        return [
            PostVisitedEvent::NAME => 'onPostVisited',
        ];
    }

    public function onPostVisited(PostVisitedEvent $event)
    {
        $this->postViewCounter->increment($event->getPost());
    }
}