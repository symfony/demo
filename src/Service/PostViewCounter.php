<?php


namespace App\Service;


use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PostViewCounter
{
    private $entityManager;
    private $session;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    public function increment(Post $post)
    {
        $this->sessionInit();
        if( ! $this->isVisited($post)) {
            $this->markAsVisited($post);
            $this->incrementViewCount($post);
        }
    }

    private function sessionInit()
    {
        if( ! $this->session->isStarted()) {
            $this->session->start();
        }
    }

    private function markAsVisited(Post $post)
    {
        $this->session->set('is_post_visited_' . $post->getId(), true);
    }

    private function incrementViewCount(Post $post)
    {
        $post->setViews($post->getViews()+1);
        $this->entityManager->flush();
    }

    private function isVisited(Post $post)
    {
        return $this->session->get('is_post_visited_' . $post->getId());
    }
}