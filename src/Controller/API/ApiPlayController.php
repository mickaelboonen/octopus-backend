<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlayRepository;

class ApiPlayController extends AbstractController
{
    private $repository;

    public function __construct(PlayRepository $playRepository )
    {
        $this->repository = $playRepository;
    }

    /**
     * @Route("/api/plays", name="app_api_plays")
     */
    public function index(): Response
    {
        return $this->json($this->repository->findAll(), Response::HTTP_OK, []);
    }

    /**
     * @Route("/api/play/{name}", name="app_api_play_name")
     */
    public function getByName(string $name): Response
    {
        return $this->json($this->repository->findByName($name), Response::HTTP_OK, []);
    }
}
