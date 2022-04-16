<?php

namespace App\Controller\Admin;

use App\Entity\Reparer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReparerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reparer::class;
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
