<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureActions(Actions $actions): Actions
    {
        $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
        $actions->remove(Crud::PAGE_INDEX, Action::EDIT);

        return $actions;
    }

    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Utilisateur")
            ->setEntityLabelInPlural("Utilisateurs")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        
        $email = EmailField::new('email', 'Email');
        $roles = ChoiceField::new('roles', 'Roles')
            ->setChoices([ // TODO : create & import enum
                'ROLE_USER' => 'Utilisateur',
                'ROLE_ADMIN' => 'Administrateur',
        ]);
        $password = TextField::new('password', 'Mot de passe');
        $isVerified = BooleanField::new('isverified', 'Utilisateur vérifié ?');
        $firstname = TextField::new('firstname', 'Prénom');
        $lastname = TextField::new('lastname', 'Nom');
        $phoneNumber = TelephoneField::new('phoneNumber', 'Téléphone');
        $birthday = DateField::new('birthday', 'Date de naissance');
        $moreInformations = TextareaField::new('moreInformations', 'Plus d\'informations');
        $lastLogin = DateTimeField::new('lastLogin', 'Dernière connexion');
        $isActive = BooleanField::new('isActive', 'Activé ?');
        // $address = AssociationField::new('address', 'Addresse');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $email,
                $firstname,
                $lastname,
                $birthday,
                $phoneNumber,
                // TextField::new('roles', 'Roles'),
                $lastLogin,
                $isVerified,
                $isActive,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $email->setColumns('col-md-4'),
                $firstname->setColumns('col-md-4'),
                $lastname->setColumns('col-md-4'),
                $birthday->setColumns('col-md-4'),
                // $roles->setColumns('col-md-4'), // TODO : not working
                $phoneNumber->setColumns('col-md-4'),
                $isVerified->setColumns('col-md-4'),
                $isActive->setColumns('col-md-4'),
                $moreInformations->setColumns('col-md-12'),
            ];
        }

        return $fields;
    }
}
