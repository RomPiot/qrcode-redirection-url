<?php

namespace App\Controller\Admin;

use App\Entity\ReparerCompany;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReparerCompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReparerCompany::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Société de réparation")
            ->setEntityLabelInPlural("Sociétés de réparation")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        // $reparerCompanyEntity = $this->getContext()->getEntity()->getInstance();

        // $user = AssociationField::new('user', 'Utilisateur');
        $name = TextField::new('name', 'Nom de la société');
        $siren = TextField::new('siren', 'Siren');
        $tvaIntercommunity = PercentField::new('tvaIntercommunity', 'TVA inter-communautaire');
        $commissionCompanyPercent = PercentField::new('commissionCompanyPercent', 'Commission de la société');
        $email = EmailField::new('email', 'Email');
        $phoneNumber = TelephoneField::new('phoneNumber', 'Téléphone');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $name,
                $email,
                $phoneNumber,
                $siren,
                $commissionCompanyPercent,
                $tvaIntercommunity,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            
            $fields = [
                $name->setColumns('col-md-4'),
                $email->setColumns('col-md-4'),
                $phoneNumber->setColumns('col-md-4'),
                $siren->setColumns('col-md-4'),
                $commissionCompanyPercent->setColumns('col-md-4'),
                $tvaIntercommunity->setColumns('col-md-4'),
                // $user->setColumns('col-md-4'),
            ];
        }

        return $fields;
    }
}
