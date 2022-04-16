<?php

namespace App\Controller\Admin;

use App\Entity\Setting;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SettingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Setting::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Paramètre")
            ->setEntityLabelInPlural("Paramètres")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        
        $name = TextField::new('name', 'Nom');
        $inputType = TextField::new('inputType', 'Type de champ');
        $userRoleAllowed = TextField::new('userRoleAllowed', 'Rôles authorisés');
        $value = TextField::new('value', 'Valeur');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $name,
                $value,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $name->setColumns('col-md-4'),
                $inputType->setColumns('col-md-4'),
                $userRoleAllowed->setColumns('col-md-4'),
                $value->setColumns('col-md-12'),
            ];
        }

        return $fields;
    }
}
