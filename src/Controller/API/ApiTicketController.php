<?php

namespace App\Controller\API;

use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TicketRepository;
use Symfony\Component\HttpFoundation\Request;

class ApiTicketController extends AbstractController
{
    private $repository;

    public function __construct(TicketRepository $ticketRepository )
    {
        $this->repository = $ticketRepository;
    }

    /**
     * @Route("/api/ticket/create", name="app_api_ticket_create")
     */
    public function createTicket(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        extract($data);
        $currentDate = new \DateTimeImmutable();

        // TODO : verif and cie
        
        $ticket = new Ticket();
        $ticket->setSubject($subject);
        $ticket->setContent($content);
        $ticket->setName($name);
        $ticket->setEmail($email);
        $ticket->setIsRead(false);
        $ticket->setIsResponse(false);
        $ticket->setParentId(null);
        $ticket->setCreatedAt($currentDate);

        
        $this->repository->add($ticket, true);

        $message = "Votre demande a bien été effectuée. Vous recevrez sous peu un mail de confirmation.";
        return $this->json($message, Response::HTTP_CREATED, []);
    }

    /**
     * @Route("/api/play/{name}", name="app_api_play_name")
     */
    public function getByName(string $name): Response
    {
        return $this->json($this->repository->findByName($name), Response::HTTP_OK, []);
    }
}
