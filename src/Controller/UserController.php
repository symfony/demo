<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Form;
use Sensio\Bundle\FrameworkExtraBundle;
use Symfony\Bundle\FrameworkBundle;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Routing;
use Symfony\Component\Security;

/**
 * Controller used to manage current user.
 *
 * @Routing\Annotation\Route("/profile")
 * @FrameworkExtraBundle\Configuration\IsGranted("ROLE_USER")
 *
 * @author Romain Monteil <monteil.romain@gmail.com>
 */
class UserController extends FrameworkBundle\Controller\AbstractController
{
    /**
     * @Routing\Annotation\Route("/edit", methods="GET|POST", name="user_edit")
     */
    public function edit(HttpFoundation\Request $request): HttpFoundation\Response
    {
        $user = $this->getUser();

        $form = $this->createForm(Form\UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'user.updated_successfully');

            return $this->redirectToRoute('user_edit');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Routing\Annotation\Route("/change-password", methods="GET|POST", name="user_change_password")
     */
    public function changePassword(
        HttpFoundation\Request $request,
        Security\Core\Encoder\UserPasswordEncoderInterface $encoder
    ): HttpFoundation\Response {
        $user = $this->getUser();

        $form = $this->createForm(Form\Type\ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $form->get('newPassword')->getData()));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('security_logout');
        }

        return $this->render('user/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
