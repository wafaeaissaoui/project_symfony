<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class CategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categorie::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInSingular('CATEGORY')
        ->setEntityLabelInPlural('CATEGORIES')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomCategorie','Category Name'),
            TextareaField::new('description','Description'),
        ];
    }
    
}
