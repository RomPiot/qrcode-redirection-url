<?php

namespace App\Controller\Admin;

use App\Entity\City;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return City::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Ville")
            ->setEntityLabelInPlural("Villes")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        
        $name = TextField::new('name', 'Nom');
        $zipcode = IntegerField::new('zipcode', 'Code Postale');
        $slug = TextField::new('slug', 'Slug');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $name,
                $zipcode,
                $slug,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $name->setColumns('col-md-4'),
                $zipcode->setColumns('col-md-4'),
                $slug->setColumns('col-md-4'),
            ];
        }

        return $fields;
    }
}
