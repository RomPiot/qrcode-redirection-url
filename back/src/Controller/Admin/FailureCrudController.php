<?php

namespace App\Controller\Admin;

use App\Entity\Failure;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FailureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Failure::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Type de Panne")
            ->setEntityLabelInPlural("Types de Panne")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        
        $name = TextField::new('name', 'Nom');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $name,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $name->setColumns('col-md-12'),
            ];
        }

        return $fields;
    }
    
}
