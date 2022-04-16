<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Client")
            ->setEntityLabelInPlural("Clients")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        // $customerEntity = $this->getContext()->getEntity()->getInstance();
        
        $user = AssociationField::new('user', 'Utilisateur');
        $firstname = TextField::new('user.firstname', 'Prénom');
        $lastname = TextField::new('user.lastname', 'Nom');
        $email = EmailField::new('user.email', 'Email');
        $roles = TextField::new('user.roles', 'Rôle');
        $phoneNumber = TelephoneField::new('user.phoneNumber', 'Téléphone');
        $birthday = DateField::new('user.birthday', 'Date de naissance');
        $lastLogin = DateTimeField::new('user.lastLogin', 'Dernière connexion');
        $isActive = BooleanField::new('user.isActive', 'Activé ?');
        $customerGroup = AssociationField::new('customerGroup', 'Groupe client');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $firstname,
                $lastname,
                $email,
                $phoneNumber,
                $customerGroup,
                $isActive,
                $lastLogin,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields[] = $firstname->setColumns('col-md-4');
            $fields[] = $lastname->setColumns('col-md-4');
            $fields[] = $email->setColumns('col-md-4');
            $fields[] = $birthday->setColumns('col-md-4');
            $fields[] = $phoneNumber->setColumns('col-md-4');
            $fields[] = $customerGroup->setColumns('col-md-4');
            $fields[] = $isActive->setColumns('col-md-4');
        }

        return $fields;
    }
}
