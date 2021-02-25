<?php

namespace App\Controller\Admin;

use App\Entity\Offre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class OffreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offre::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInSingular('OFFER')
        ->setEntityLabelInPlural('OFFERS')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('dateDebut','Start Date'),
            DateField::new('dateFin','End Date'),
            Field::new('nPrix','New Price'),
            AssociationField::new('article','Product')
                ->autocomplete(),
        ];
    }
    
}
