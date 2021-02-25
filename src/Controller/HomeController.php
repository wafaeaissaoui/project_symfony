<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\ArticlePanier;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $repos= $this->getDoctrine()->getRepository(Article::class);
        $articles=$repos->findAll();

        $repos2= $this->getDoctrine()->getRepository(Categorie::class);
        $categorie=$repos2->findAll();

        $repos3= $this->getDoctrine()->getRepository(ArticlePanier::class);
        $articleBestSellers=$repos3->findAll();

        $cpt = 0;$var = 0;
        foreach ($categorie as $cat){
            if ($cpt < 1){
                $var = $cat->getId();
            }
            $cpt = $cpt + 1;
        }

        $session = $this->get('session');        
        $session->set('var', $var);

        $cpt = $session->get('countPanier');
        if(Empty($cpt)){
            $cpt = 0;
            $session->set('countPanier', $cpt);
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController', 'article'=>$articles, 'categorie'=>$categorie, 'bestSellers' => $articleBestSellers
        ]);
    }
}
