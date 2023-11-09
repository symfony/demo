<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Comment')
            ->setEntityLabelInPlural('Blog Comments')
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addColumn('col-xl-8 col-xxl-8');
        yield FormField::addFieldset();
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('content')->onlyOnIndex()->setMaxLength(36);
        yield TextEditorField::new('content')->setNumOfRows(10)->hideOnIndex();

        yield FormField::addColumn('col-xl-4 col-xxl-4');
        yield FormField::addFieldset();
        yield AssociationField::new('author');
        yield AssociationField::new('post')->autocomplete();
        yield DateTimeField::new('publishedAt')->setFormat('short', 'short');
    }
}
