<?php

namespace App\Controller\EasyAdmin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('fullName')
            ->add('username')
            ->add('email')
            ->add('roles');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnDetail();
        yield AvatarField::new('email')->setIsGravatarEmail()->onlyOnIndex();
        yield TextField::new('fullName')->setColumns('col-12 col-xl-8 col-xxl-6');
        yield FormField::addRow();
        yield TextField::new('username')->setColumns('col-8 col-xl-6 col-xxl-4')
            ->setDisabled(Crud::PAGE_EDIT === $pageName)
            ->setHelp(match($pageName) {
                Crud::PAGE_NEW => '<b class="text-danger">Important:</b> Change this randomly-generated username.',
                Crud::PAGE_EDIT => 'The username can\'t be changed after the user is created.',
                default => '',
            });
        yield FormField::addRow();
        yield EmailField::new('email')->setColumns('col-12 col-xl-8 col-xxl-6');
        yield ChoiceField::new('roles')->setChoices([
            'User' => 'ROLE_USER',
            'Admin' => 'ROLE_ADMIN',
        ])->renderAsBadges([
            'ROLE_USER' => 'primary',
            'ROLE_ADMIN' => 'success',
        ])->renderExpanded()->allowMultipleChoices();
    }
}
