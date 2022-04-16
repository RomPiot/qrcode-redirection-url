<?php

namespace App\Controller\Admin;

use App\Entity\CustomerGroup;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CustomerGroupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CustomerGroup::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Groupe client")
            ->setEntityLabelInPlural("Groupes client")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        
        $name = TextField::new('name', 'Nom');
        $code = TextField::new('code', 'Code');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $name,
                $code,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $name->setColumns('col-md-8'),
                $code->setColumns('col-md-4'),
            ];
        }

        return $fields;
    }
}
