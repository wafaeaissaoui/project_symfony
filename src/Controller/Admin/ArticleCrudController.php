<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInSingular('PRODUCT')
        ->setEntityLabelInPlural('PRODUCTS')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $nomArticle = TextField::new('nomArticle','Product Name');
        $imageArticle = ImageField::new('imageArticle','Image');
        $imageArticle2 = Field::new('imageArticle','Image');
        $Description = TextareaField::new('description','Description');
        $prix = Field::new('prix','Price');
        $quantiteEnStock = Field::new('quantiteEnStock','Quantity');
        $idCategorie = AssociationField::new('categorie','Category')->autocomplete();


        if (Crud::PAGE_INDEX === $pageName) {
            return [$nomArticle, $imageArticle, $Description, $prix, $quantiteEnStock, $idCategorie];
        } else {
            return [$nomArticle, $imageArticle2, $Description, $prix, $quantiteEnStock, $idCategorie];
        }
    }
    
}
