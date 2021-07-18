<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Comment;
use App\Entity\FormFieldReference;
use App\Entity\Post;
use App\Entity\Tag;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/easyadmin", name="easyadmin")
     */
    public function index(): Response
    {
        $adminUrlGenerator = $this->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(PostCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Easyadmin Demo');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateTimeFormat('medium', 'short');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getFullName());
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Blog Posts', 'fa fa-file-text-o', Post::class);
        yield MenuItem::linkToCrud('Comments', 'far fa-comments', Comment::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tag::class);

        yield MenuItem::section('Resources');
        yield MenuItem::linkToUrl('EasyAdmin Docs', 'fas fa-book', 'https://symfony.com/doc/current/bundles/EasyAdminBundle/index.html')->setLinkTarget('_blank');
        yield MenuItem::linkToCrud('Form Field Reference', 'far fa-file-code', FormFieldReference::class)->setAction(Action::NEW);

        yield MenuItem::section('Links');
        yield MenuItem::linkToUrl('Symfony Demo', 'fab fa-symfony', 'https://github.com/symfony/demo')->setLinkTarget('_blank');
        yield MenuItem::linkToUrl('EasyAdmin Demo', 'fas fa-magic', 'https://github.com/EasyCorp/easyadmin-demo')->setLinkTarget('_blank');
        yield MenuItem::linkToUrl('Sponsor EasyAdmin', 'fa fa-euro-sign', 'https://github.com/sponsors/javiereguiluz')->setLinkTarget('_blank');
    }
}
