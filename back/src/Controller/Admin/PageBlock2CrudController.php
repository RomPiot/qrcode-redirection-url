<?php

namespace App\Controller\Admin;

use App\Entity\PageBlock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PageBlock2CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PageBlock::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
