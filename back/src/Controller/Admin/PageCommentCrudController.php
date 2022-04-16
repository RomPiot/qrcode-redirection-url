<?php

namespace App\Controller\Admin;

use App\Entity\PageComment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageCommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PageComment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Commentaire de page")
            ->setEntityLabelInPlural("Commentaires de page")
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [];

        $publishedAt = DateTimeField::new('publishedAt', 'Publié le');
        $page = TextField::new('page', 'Page');
        $author = TextField::new('author', 'Auteur');
        $content = TextField::new('content', 'Contenu');
        $active = BooleanField::new('isActive', 'Actif ?');

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $page,
                $author,
                $content,
                $active,
                $publishedAt
            ];
        }

        if (($pageName === Crud::PAGE_NEW) || ($pageName === Crud::PAGE_EDIT)) {
            $fields = [
                $page->setDisabled()->setColumns('col-md-6'),
                $author->setDisabled()->setColumns('col-md-6'),
                $active->setColumns('col-md-12'),
                $content->setColumns('col-md-12'),
            ];
        }

        return $fields;
    }
}
