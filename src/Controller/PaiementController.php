<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Categorie;
use App\Entity\Panier;
use App\Entity\ArticlePanier;
use App\Entity\Paiement;

class PaiementController extends AbstractController
{
    /**
     * @Route("/paiement", name="paiement")
     */
    public function index(SessionInterface $session, ArticleRepository $productRepository)
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach($panier as $id => $quantity){
            $panierWithData[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach($panierWithData as $item){
            $totalItem = $item['product']->getPrix() * $item['quantity'];
            $total += $totalItem;
        }


        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController', 'items' => $panierWithData, 'total' => $total
        ]);
    }

    /**
     * @Route("/addpaiement", name="create_paiement")
     */
    public function createPaiement(SessionInterface $session, ArticleRepository $productRepository, Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();




        $entityManager = $this->getDoctrine()->getManager();

        $panier = new Panier();
        $panier->setUser($user);
        $entityManager->persist($panier);
        $entityManager->flush();

        $panier2 = $session->get('panier', []);

        $panierWithData = [];

        $cpt = $session->get('countPanier');
        foreach($panier2 as $id => $quantity){
            $articlePanier = new ArticlePanier();
            $articlePanier->setPanier($panier);
            $articlePanier->setArticle($productRepository->find($id));
            $articlePanier->setQuantite($quantity);
            $entityManager->persist($articlePanier);
            $entityManager->flush();
            unset($panier2[$id]);
            $cpt--;
        }

        $session->set('panier', $panier2);
        $session->set('countPanier', $cpt);

 

        $paiement = new Paiement();
        $paiement->setPanier($panier);
        $paiement->setModePaiement("Direct Bank Transfer");
        $paiement->setDatePaiement(new \DateTime('now'));
        $entityManager->persist($paiement);
        $entityManager->flush();

        return $this->redirectToRoute("order_placed");
    }


    /**
     * @Route("/oderPlaced", name="order_placed")
     */
    public function orderPlaced(){
        return $this->render('paiement/orderPlaced.html.twig', [
            'controller_name' => 'PaiementController'
        ]);
    }
}
