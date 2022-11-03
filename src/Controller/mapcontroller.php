<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class mapcontroller extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(): Response
    {
        return $this->render('home/index.html.twig', [
            'title1' => 'Welcome to the homepage',
    ]);
    }

    #[Route('/forms/{slug}', name: ('forms'))]
    public function form($slug = null): Response
    {
#        if ($slug) {
#            $title = 'Form page: ' .u(str_replace('-', ' ', $slug))->title(true);
#        } else {
#            $title = 'Form page: Main';
#        }

        $block = $slug ? u(str_replace('-', ' ', $slug))->title(true):null;
        return $this->render('home/form.html.twig', [
            'title2' => $block,
        ]);
    }
}