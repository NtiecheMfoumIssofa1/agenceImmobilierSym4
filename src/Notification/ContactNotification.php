<?php
namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;

class ContactNotification{

    /**
     * @var \Swift_Mailer
    */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact){
        $message = (new \Swift_Message(
                    'Agence Tiefa: ', $contact->getProperty()->getTitle()))
             //->setFrom($contact->getEmail())
            ->setFrom('youssouf.tiefa@gmail.com')
            ->setTo('youssouf.tiefa@gmail.com')
            ->setReplyTo('youssouf.tiefa@gmail.com') //l'email de l'utilisateur
            ->setBody($this->renderer->render('emails/contact.html.twig',[
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send(($message));
    }
}