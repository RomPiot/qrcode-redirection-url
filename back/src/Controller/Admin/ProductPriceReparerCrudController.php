<?php

namespace App\Controller\Admin;

use App\Entity\ProductPriceReparer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductPriceReparerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductPriceReparer::class;
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
