<?php

namespace App\Controller\Admin;

use App\Entity\ProductBrand;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductBrandCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductBrand::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Marque")
            ->setEntityLabelInPlural("Marques")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];

        $imageField = TextField::new('imageFile', 'Image')
            ->setFormType(VichImageType::class);

        $image = ImageField::new('image', 'Image')
            ->setBasePath('/uploads/images/product-brands')
            ->setUploadDir('public/uploads/images/product-brands');

        $name = TextField::new('name', 'Nom');
        $slug = TextField::new('slug', 'Slug');
        $isActive = BooleanField::new('isActive', 'Activé ?');
        $commissionMogamo = PercentField::new('commissionMogamo', 'Commision Mogamo');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $name,
                $image,
                $slug,
                $commissionMogamo,
                $isActive,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $name->setColumns('col-md-4'),
                $slug->setColumns('col-md-4'),
                $commissionMogamo->setColumns('col-md-4'),
                $image,
                $isActive->setColumns('col-md-4'),
            ];
        }

        return $fields;
    }
}
