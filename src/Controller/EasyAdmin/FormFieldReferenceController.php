<?php

namespace App\Controller\EasyAdmin;

use App\Entity\FormFieldReference;
use App\Entity\Post;
use App\Entity\User;
use App\Form\Type\CollectionComplexType;
use App\Form\Type\CollectionSimpleType;
use App\Form\Type\TagsInputType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CurrencyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\LanguageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\LocaleField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimezoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class FormFieldReferenceController extends AbstractCrudController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public static function getEntityFqcn(): string
    {
        return FormFieldReference::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_NEW, 'Form Field Reference');
    }

    public function configureFields(string $pageName): iterable
    {
        $choices = ['Choice 1' => 0, 'Choice 2' => 1, 'Choice 3' => 2];

        return [
            FormField::addPanel('Text Fields'),
            TextField::new('text', 'Text Field'),
            SlugField::new('slug', 'Slug Field')->setTargetFieldName('text'),
            TextareaField::new('textarea', 'Textarea Field'),
            TextEditorField::new('textEditor', 'Text Editor Field'),
            CodeEditorField::new('codeEditor', 'Code Editor Field')->setNumOfRows(12)->setLanguage('php'),

            FormField::addPanel('Choice Fields'),
            BooleanField::new('boolean', 'Boolean Field'),
            ChoiceField::new('autocomplete', 'Choice Field (autocomplete)')->setChoices($choices)->allowMultipleChoices()->autocomplete(),
            ChoiceField::new('checkbox', 'Choice Field (checkbox)')->setChoices($choices)->allowMultipleChoices()->renderExpanded(),
            ChoiceField::new('radiobutton', 'Choice Field (radiobutton)')->setChoices($choices)->renderExpanded(),

            FormField::addPanel('Numeric Fields'),
            IntegerField::new('integer', 'Integer Field'),
            NumberField::new('decimal', 'Number Field'),
            PercentField::new('percent', 'Percent Field')->setColumns(2),
            FormField::addRow(),
            MoneyField::new('money', 'Money Field')->setCurrency('EUR')->setColumns(3),

            FormField::addPanel('Date and Time Fields'),
            DateField::new('date', 'Date Field'),
            TimeField::new('time', 'Time Field'),
            DateTimeField::new('datetime', 'DateTime Field'),
            TimezoneField::new('timezone', 'Timezone Field'),

            FormField::addPanel('Internationalization Fields'),
            CountryField::new('country', 'Country Field'),
            CurrencyField::new('currency', 'Currency Field'),
            LanguageField::new('language', 'Language Field'),
            LocaleField::new('locale', 'Locale Field'),

            FormField::addPanel('Association & Collection Fields'),
            ArrayField::new('array', 'Array Field'),
            AssociationField::new('author', 'Association Field'),
            CollectionField::new('collectionSimple', 'Collection Field (simple)')->setFormTypeOption('entry_type', CollectionSimpleType::class),
            CollectionField::new('collectionComplex', 'Collection Field (complex)')->setFormTypeOption('entry_type', CollectionComplexType::class)->setEntryIsComplex(true),

            FormField::addPanel('Image Fields'),
            ImageField::new('image', 'Image Field')->setUploadDir('/public/images/'),

            FormField::addPanel('Other Fields'),
            IdField::new('id', 'Id Field')->setColumns(2),
            FormField::addRow(),
            ColorField::new('color', 'Color Field'),
            EmailField::new('email', 'Email Field'),
            TelephoneField::new('telephone', 'Telephone Field'),
            UrlField::new('url', 'Url Field'),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $janeDoe = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'jane_admin']);
        $johnDoe = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'john_user']);
        $formFieldReference = parent::createEntity($entityFqcn);

        $formFieldReference->author = $janeDoe;

        $formFieldReference->collectionSimple = [$janeDoe, $johnDoe];
        $formFieldReference->collectionComplex = [$janeDoe, $johnDoe];

        return $formFieldReference;
    }
}
