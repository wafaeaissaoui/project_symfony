<?php


namespace App\Notification;

// On importe les classes nécessaires à l'envoi d'e-mail et à Twig
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Contact;

class Notificate
{ 
    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        //$this->renderer = $renderer;
    }
    public function notify(Contact $contact)
    {
        // On construit le mail
        //$message = (new Swift_Message('Mon Blog - Nouvelle inscription'))
            // Expéditeur
            $email=(new Email())
            ->From($contact->getEmail())
            // Destinataire
            ->To('wafaeissa17@gmail.com')
            // Corps du message (créé avec twig)
            ->replyTo($contact->getEmail())
            ->subject($contact->getObjet())
            ->Text($contact->getMessage());
            $this->mailer->send($email);

        // On envoie le mail
        $this->mailer->send($email);
    }
}