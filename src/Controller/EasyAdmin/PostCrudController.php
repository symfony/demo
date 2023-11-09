<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Blog Post')
            ->setEntityLabelInPlural('Blog Posts')
            ->setDefaultSort(['publishedAt' => 'DESC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('author')
            ->add('publishedAt')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addColumn('col-xxl-8');
        yield FormField::addFieldset();
        yield TextField::new('title');
        yield TextareaField::new('summary')
            ->setMaxLength(36)
            ->setNumOfRows(3)
            ->setHelp('Summaries can\'t contain Markdown or HTML contents; only plain text.');

        yield FormField::addColumn('col-xxl-4');
        yield FormField::addFieldset();
        yield AssociationField::new('author');
        yield AssociationField::new('comments')->onlyOnIndex();
        $isIndexPage = Crud::PAGE_INDEX === $pageName;
        yield DateTimeField::new('publishedAt')->setFormat($isIndexPage ? 'medium' : 'long', $isIndexPage ? 'none' : 'medium');
        yield AssociationField::new('tags')->hideOnIndex();

        yield FormField::addColumn('col-xxl-10');
        yield FormField::addFieldset();
        yield CodeEditorField::new('content')->hideOnIndex()
            ->setNumOfRows(35)->setLanguage('markdown')
            ->setHelp('Use Markdown to format the blog post contents. HTML is allowed too.');
    }
}
