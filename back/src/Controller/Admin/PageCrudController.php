<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Entity\PageBlock;
use App\Form\PageBlockAdminType;
use App\Form\PageBlockType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Page")
            ->setEntityLabelInPlural("Pages")
        ;
    }
   
    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }

    public function configureFields(string $pageName): iterable
    {   
        $entity = $this->getContext()->getEntity()->getInstance();
        $fields = [];

        $imageField = TextField::new('imageFile', 'Image')
            ->setFormType(VichImageType::class);

        $image = ImageField::new('image', 'Image')
            ->setBasePath('/uploads/images/pages')
            ->setUploadDir('public/uploads/images/pages');

        $title = TextField::new("title", 'Titre');
        $active = BooleanField::new('isActive', 'Activé ?');
        $publishedAt = DateTimeField::new('publishedAt', 'Publié le');
        $type = TextField::new('type');
        $author = AssociationField::new('author', 'Auteur');
        $relatedCity = AssociationField::new('relatedCity', 'Ville');
        $relatedFailure = AssociationField::new('relatedFailure', 'Type de panne');
        $pageBlocks = CollectionField::new('pageBlocks', 'Blocks')
                ->setEntryType(PageBlockType::class);

        // \dd($pageBlocks->getAsDto());
        // foreach ($pageBlocks as $pageBlock) {
        //     \dump($pageBlock);
        // }
        // \dd();

        // if ($entity) {
        //     $em = $this->getDoctrine();
        //     $pageBlockRepository = $em->getRepository(PageBlock::class);
        //     $blockEntities = $pageBlockRepository->findBy(['page' => $entity->getId()]);

        //     foreach ($blockEntities as $blockEntity) {
        //         \dump($blockEntity);
        //         if ($blockEntity->getType() == 'text') {
        //             $pageBlocks[] = TextareaField::new('pageModel.pageBlocks.content', 'Header 1');
        //         } else if ($blockEntity->getType() == 'string') {
        //             $pageBlocks[] = TextField::new('pageModel.pageBlocks.content', 'Header 1');
        //         } else if ($blockEntity->getType() == 'image') {
        //             $pageBlocks[] = TextField::new('pageModel.pageBlocks.content', 'Header 1');
        //         } else if ($blockEntity->getType() == 'html') {
        //             $pageBlocks[] = TextField::new('pageModel.pageBlocks.content', 'Header 1');
        //         }
        //     }
        //     \dd($blockEntities);

        // } 

        if ($pageName === Crud::PAGE_INDEX) {
            $fields = [
                $title,
                $image,
                $publishedAt,
                $type, 
                $active,
                $author,
                $relatedCity,
                $relatedFailure,
            ];
        }

        if ($pageName === Crud::PAGE_DETAIL) {
            $fields[] = $imageField;

            
        }

        if ($pageName === Crud::PAGE_NEW) {
            $fields = [
                $active->setColumns(3),
                BooleanField::new('isCommentAllowed', 'Autoriser les commentaires ?')
                    ->setColumns(3),
                FormField::addPanel(' '),
                $title->setColumns('col-md-12'),
                SlugField::new('slug')
                    ->setTargetFieldName('title')
                    ->setColumns('col-md-12'),
                FormField::addPanel('SEO'),
                TextField::new('metaTitle')->setColumns('col-md-12'),
                TextareaField::new('metaDescription')->setColumns('col-md-12'),
                FormField::addPanel('Configuration'),
                // $pageModelBlocks ? $pageModelBlocks->setColumns('col-md-12') : null,
                $image,
                $relatedCity->setColumns(6),
                $relatedFailure->setColumns(6),
                $type,
                $pageBlocks
                // TODO : AssociationField::new('author'), 
            ];

        }

        if ($pageName === Crud::PAGE_EDIT) {
            $fields = [
                $active->setColumns(3),
                BooleanField::new('isCommentAllowed', 'Autoriser les commentaires ?')
                    ->setColumns(3), 
                FormField::addPanel(' '),
                $title->setColumns('col-md-12'),
                SlugField::new('slug')
                    ->setTargetFieldName('title')
                    ->setColumns('col-md-12'),
                FormField::addPanel('SEO'),
                TextField::new('metaTitle')->setColumns('col-md-12'),
                TextareaField::new('metaDescription')->setColumns('col-md-12'),
                FormField::addPanel('Configuration'),
                // isset($pageModelBlocks) ? $pageModelBlocks->setColumns('col-md-12') : null,
                $imageField,
                $relatedCity->setColumns(6),
                $relatedFailure->setColumns(6),
                $type,
                $pageBlocks ? $pageBlocks->setColumns('col-md-12') : null,
                // TODO : AssociationField::new('author'), 
            ];

            // if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            //     $fields = [
            //         $name,
            //     ];
            // }

        }

        return $fields;
    }
}
