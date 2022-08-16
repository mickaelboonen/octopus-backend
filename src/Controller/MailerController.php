<?php 

// src/Controller/MailerController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/api/subscription-confirmation", name="app_api_email_subscription")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
        ->from('boonentest@gmail.com')
        ->to('mickael.kern@hotmail.fr')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        // dd($email);
        $mailer->send($email);
        return $this->json($email, Response::HTTP_OK, []);
        // ...
    }
}