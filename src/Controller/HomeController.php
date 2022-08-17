<?php

namespace App\Controller;

use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends AbstractController
{

    private $ticketRepository;

    public function __construct (TicketRepository $ticketRepository) {
        
        $this->ticketRepository = $ticketRepository;
    }
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        // $tickets = new TicketRepository();
        $tickets = $this->ticketRepository->findByIsRead(0);
        dump($tickets);

        $session = new Session();
        $session->start();

        $session->set('notifications', count($tickets));

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'notifications' => count($tickets),
        ]);
    }
}
