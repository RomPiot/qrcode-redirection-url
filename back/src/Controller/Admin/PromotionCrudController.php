<?php

namespace App\Controller\Admin;

use App\Entity\Promotion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PromotionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Promotion::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Promotion")
            ->setEntityLabelInPlural("Promotions")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        
        $name = TextField::new('name', 'Nom');
        $isActive = BooleanField::new('isActive', 'Activé ?');
        $code = TextField::new('code', 'Code');
        $description = TextEditorField::new('description', 'Description');
        $type = TextField::new('type', 'Type');
        $usageLimit = IntegerField::new('usageLimit', 'Limite d\'utilisation');
        $used = IntegerField::new('used', 'Utilisé');
        $startAt = DateTimeField::new('startAt', 'Date de début');
        $endAt = DateTimeField::new('endAt', 'Date de fin');
        $percent = PercentField::new('percent', 'Pourcentage');


        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $name,
                $code,
                $percent,
                $description,
                $usageLimit,
                $used,
                $startAt,
                $endAt,
                $isActive,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $name->setColumns('col-md-4'),
                $code->setColumns('col-md-4'),
                $percent->setColumns('col-md-4'),
                $description->setColumns('col-md-12'),
                $usageLimit->setColumns('col-md-4'),
                $startAt->setColumns('col-md-4'),
                $endAt->setColumns('col-md-4'),
                $isActive->setColumns('col-md-4'),
            ];
        }

        return $fields;
    }
}
