<?php 

namespace App\Service;

// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService 
{
    private $mailer;

    public function __construct (MailerInterface $mailer) {
        $this->mailer = $mailer;
    }

    public function sendEmail(string $content = '<p>See Twig integration for better HTML integration!</p>', string $to = 'boonentest@gmail.com') : void
    {
        $email = (new Email())
        ->from('boonentest@gmail.com')
        ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            // ->text('Sending emails is fun again!')
            ->html($content);

        // dd($email);
        $this->mailer->send($email);
    }
}