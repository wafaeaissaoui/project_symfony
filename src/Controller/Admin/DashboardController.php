<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;


use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Article;
use App\Entity\Offre;

use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //return parent::index();
        // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(CategorieCrudController::class)->generateUrl());

    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('assets/css/admin.css');
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<span style="color: #3CB878;font-weight: bold;">RENOSHOP</span><span style="color: black;font-weight: bold;">BEE</span>');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
        
        
        return [
            //MenuItem::linktoDashboard('Home', 'fa fa-home'),
            // ...
    
            MenuItem::section('Categories'),
            MenuItem::linkToCrud('CATEGORIES', 'fa fa-list', Categorie::class),
            MenuItem::linkToCrud('ADD CATEGORY', 'fa fa-plus-circle', Categorie::class)
                ->setAction('new'),
     


            MenuItem::section('Products'),
            MenuItem::linkToCrud('PRODUCTS', 'fa fa-box', Article::class),
            MenuItem::linkToCrud('ADD PRODUCT', 'fa fa-plus-circle', Article::class)
                ->setAction('new'),


            MenuItem::section('Offers'),
            MenuItem::linkToCrud('OFFERS', 'fa fa-gift', Offre::class),
            MenuItem::linkToCrud('ADD OFFER', 'fa fa-plus-circle', Offre::class)
                ->setAction('new'),


            MenuItem::section('Users')
            ->setPermission('ROLE_SUPERADMIN'),
            MenuItem::linkToCrud('USERS', 'fa fa-user', User::class)
            ->setPermission('ROLE_SUPERADMIN'),
            MenuItem::linkToCrud('ADD USER', 'fa fa-plus-circle', User::class)
                ->setAction('new')
                ->setPermission('ROLE_SUPERADMIN'),

            MenuItem::section('Public Website'),
            MenuItem::linkToUrl('VISIT PUBLIC WEBSITE', 'fa fa-globe', '/'),
        ];
    }
}
