<?php

namespace App\Controller\Admin;

use App\Entity\PageRedirection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageRedirectionCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return PageRedirection::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Redirection de page")
            ->setEntityLabelInPlural("Redirections de page")
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [];

        $fromUrl = TextField::new('fromUrl', 'Depuis l\'URL');
        $toUrl = TextField::new('toUrl', 'Vers l\'URL');
        $comment = TextField::new('comment', 'Commentaire');
        // $active = BooleanField::new('isActive', 'Actif ?');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $fromUrl,
                $toUrl,
                $comment
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $fromUrl->setColumns('col-md-12'),
                $toUrl->setColumns('col-md-12'),
                $comment->setColumns('col-md-12')
            ];
        }

            return $fields;
        }
}
