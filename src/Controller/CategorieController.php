<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use App\Entity\Categorie;
use App\Entity\Article;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie/{id}", name="categorie")
     */
    public function index($id)
    {
        $repos= $this->getDoctrine()->getRepository(Categorie::class);
        $categories=$repos->findAll();

        $repos2= $this->getDoctrine()->getRepository(Article::class);
        $articles=$repos2->findByCategorie($id);

        $repos3= $this->getDoctrine()->getRepository(Article::class);
        $articlesTop=$repos3->findAll();

        return $this->render('categorie/index.html.twig', [
            'article'=>$articles, 'categorie'=>$categories, 'TopRated'=>$articlesTop
        ]);
    }

    /**
     * @Route("/categorieProduit/{id}", name="categorieProduit")
     */
    public function ProduitParCategorie($id)
    {
        $repos2= $this->getDoctrine()->getRepository(Categorie::class);
        $categories=$repos2->findAll();

        $repos= $this->getDoctrine()->getRepository(Article::class);
        $articles=$repos->findByCategorie($id);

        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'ArticleController', 'article'=>$articles, 'categorie'=>$categories
        ]);
    }
}
