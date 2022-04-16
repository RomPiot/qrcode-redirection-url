<?php

namespace App\Controller\Admin;

use App\Entity\Country;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CountryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Country::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Pays")
            ->setEntityLabelInPlural("Pays")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        
        $name = TextField::new('name', 'Nom');
        $code = TextField::new('code', 'Code');
        $slug = TextField::new('slug', 'Slug');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $name,
                $slug,
                $code,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $name->setColumns('col-md-4'),
                $slug->setColumns('col-md-4'),
                $code->setColumns('col-md-4'),
            ];
        }

        return $fields;
    }
}
