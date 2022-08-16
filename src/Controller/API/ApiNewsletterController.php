<?php

namespace App\Controller\API;

use App\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NewsletterRepository;
use App\Service\MailerService;

class ApiNewsletterController extends AbstractController
{
    private $repository;

    public function __construct(NewsletterRepository $newsletterRepository )
    {
        $this->repository = $newsletterRepository;
    }

    // /**
    //  * @Route("/api/subscribers", name="app_api_subscribers_list")
    //  */
    // public function index(): Response
    // {
    //     return $this->json($this->repository->findAll(), Response::HTTP_OK, []);
    // }

    /**
     * @Route("/api/newsletter/subscribe", name="app_api_subscribe", methods={"POST"})
     */
    public function subscribe(Request $request, MailerService $mailer): Response
    {
        $data = json_decode($request->getContent(), true);
        $message = '';

        $subscriber = new Newsletter();

        if ($this->repository->findByEmail($data['email'])) {
            $message = "Cette adresse email est déjà utilisée dans notre liste de diffusion, merci d'en renseigner une autre.";
        }
        else {
            $currentDate = new \DateTimeImmutable();
            $subscriber->setEmail($data['email']); 
            $subscriber->setCreatedAt($currentDate); 
        }
        
        if ($message === '') {
            $this->repository->add($subscriber, true);
            $message = "Votre inscription à la newsletter a été prise en compte. Vous recevrez sous peu un mail de confirmation.";


            $mailMessage = 'YATA !';


            // $mailer->sendEmail($mailMessage);

            return $this->json($message, Response::HTTP_CREATED, []);
        }
        else {
            $mailMessage = 'YATA !';

            // $mailer->sendEmail($mailMessage);
            return $this->json($message, Response::HTTP_UNAUTHORIZED, []);
        }
    } 

    /**
     * @Route("/api/newsletter/unsubscribe/{id}", name="app_api_unsubscribe", methods={"DELETE"})
     */
    public function unsubscribe(Request $request, MailerService $mailer): Response
    {
        $path = $request->getPathInfo();
        $pathArray = explode('/', $path);
        $idToDelete = $pathArray[count($pathArray) - 1];
        $message = '';
        $subscriber = $this->repository->findById((int) $idToDelete);

        if (count($subscriber) > 0) {

            $this->repository->remove($subscriber[0], true); 
        
            $message = 'Vous avez bien été retiré de la newsletter';

            return $this->json($message, Response::HTTP_OK, []);


        }
        else {
            $message = "Cet email n'est pas enregistré dans notre base de données";

            return $this->json($message, Response::HTTP_NOT_FOUND, []);

        }
    } 
    /**
     * @Route("/api/newsletter/get_id", name="app_api_newsletter_getid", methods={"POST"})
     */
    public function getId(Request $request, MailerService $mailer): Response
    {
        $data = json_decode($request->getContent(), true);
        $subscriber = $this->repository->findByEmail($data['email']);

        if (count($subscriber) > 0) {

            return $this->json($subscriber, Response::HTTP_OK, []);

        }
        else {
            $message = "Cet email n'est pas enregistré dans notre base de données";

            return $this->json($message, Response::HTTP_NOT_FOUND, []);

        }
    } 
}
