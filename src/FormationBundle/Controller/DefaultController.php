<?php

namespace FormationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @param $civility
     * @param $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($civility, $name)
    {
        return $this->render('FormationBundle:Default:index.html.twig', [
            'civility' => $civility,
            'name'     => $name,
        ]);
    }
}
