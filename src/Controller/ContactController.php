<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Notification\Notificate;
use App\Form\ContactType;
use App\Entity\Contact;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request,Notificate $email)
    {
        $contact= new contact();
        $form=$this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
         $email->notify($contact);
         return $this->redirectToRoute('home');
        }

        return $this->render('contact/index.html.twig', [
            'formcontact' => $form->createView(),
        ]);
    }
}
