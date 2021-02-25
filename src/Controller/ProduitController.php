<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use App\Entity\Article;
use App\Entity\Offre;
use App\Entity\Categorie;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="produit")
     */
    public function index()
    {
        $repos= $this->getDoctrine()->getRepository(Article::class);
        $articles=$repos->findAll();

        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController', 'article'=>$articles
        ]);
    }

    /**
     * @Route("/detailProduit/{id}", name="detailProduit")
     */
    public function detailProduit($id)
    {
        $repos= $this->getDoctrine()->getRepository(Article::class);
        $article=$repos->find($id);

        $repos2= $this->getDoctrine()->getRepository(Article::class);
        $article2=$repos2->findByCategorie($article->getCategorie());

        return $this->render('produit/detailProduit.html.twig', [
            'controller_name' => 'ProduitController', 'article'=>$article, 'relatedProduct'=>$article2
        ]);
    }

    /**
     * @Route("/offre", name="offre")
     */
    public function offre()
    {
        $repos= $this->getDoctrine()->getRepository(Article::class);
        $articles=$repos->findAll();

        $repos2= $this->getDoctrine()->getRepository(Offre::class);
        $offres=$repos2->findByArticle($articles);

        $repos3= $this->getDoctrine()->getRepository(Categorie::class);
        $categorie=$repos3->findAll();
        
        return $this->render('produit/offre.html.twig', [
            'controller_name' => 'ProduitController', 'article'=>$articles, 'offre'=>$offres, 'categorie'=>$categorie
        ]);
    }



}
