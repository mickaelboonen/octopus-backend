<?php

namespace App\Controller\API;

use App\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NewsletterRepository;

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
    public function subscribe(Request $request): Response
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
            return $this->json($message, Response::HTTP_CREATED, []);
        }
        else {
            return $this->json($message, Response::HTTP_UNAUTHORIZED, []);
        }
    } 
}
