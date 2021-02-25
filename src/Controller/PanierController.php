<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\ArticleRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
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


        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController', 'items' => $panierWithData, 'total' => $total
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add($id, SessionInterface $session){

        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else{
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        $cpt = $session->get('countPanier');
        if(Empty($cpt)){
            $cpt = 0;
        }
        $cpt++;
        $session->set('countPanier', $cpt);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, SessionInterface $session){
            $panier = $session->get('panier', []);

            if(!empty($panier[$id])){
                unset($panier[$id]);
            }

            $session->set('panier', $panier);

            $cpt = $session->get('countPanier');
            $cpt--;
            $session->set('countPanier', $cpt);

            return $this->redirectToRoute("cart_index");
    }
}
