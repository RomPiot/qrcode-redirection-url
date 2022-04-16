<?php

namespace App\Controller\Admin;

use App\Entity\PageBlock;
use App\Enum\AdminFieldType;
use App\Form\PageBlockType;
use App\Form\PageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageBlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PageBlock::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('page'),
            TextField::new('type'),
            ChoiceField::new('type', 'Type')
                ->setChoices([
                        'Image' => 'image',
                        'HTML' => 'html',
                        'Texte' => 'text',
                        'String' => 'string'
                ]),
            TextField::new('name'),
            IntegerField::new('position'),
        ];
    }
}
