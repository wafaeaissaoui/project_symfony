<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInSingular('USER')
        ->setEntityLabelInPlural('USERS')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email','E-mail'),
            TextField::new('username'),
            TextField::new('nom','Family Name'),
            TextField::new('prenom','First Name'),
            TextField::new('telephone','Phone'),
            TextareaField::new('adresse','Address'),
            ArrayField::new('roles'),
        ];
    }
    
}
