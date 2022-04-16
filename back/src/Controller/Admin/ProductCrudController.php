<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\DomCrawler\Field\ChoiceFormField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Produit")
            ->setEntityLabelInPlural("Produits")
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        
        $name = TextField::new('name', 'Nom');
        $slug = TextField::new('slug', 'Slug');
        $isActive = BooleanField::new('isActive', 'Activé ?');
        $description = TextEditorField::new('description', 'Description');
        $discountPercent = PercentField::new('discountPercent', 'Pourcentage de réduction');
        $brand = AssociationField::new('brand', 'Marque');
        $category = AssociationField::new('category', 'Catégorie');
        $price = NumberField::new('price', 'Prix');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $category,
                $name,
                $price,
                $discountPercent,
                $description,
                $brand,
                $isActive,
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $category->setColumns('col-md-4'),
                $brand->setColumns('col-md-4'),
                $name->setColumns('col-md-4'),
                $slug->setColumns('col-md-4'),
                $description->setColumns('col-md-12'),
                $price->setColumns('col-md-4'),
                $discountPercent->setColumns('col-md-4'),
                $isActive->setColumns('col-md-4'),
            ];
        }

        return $fields;
    }


}
