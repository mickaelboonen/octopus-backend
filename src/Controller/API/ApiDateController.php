<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DateRepository;

class ApiDateController extends AbstractController
{
    private $repository;

    public function __construct(DateRepository $dateRepository )
    {
        $this->repository = $dateRepository;
    }

    /**
     * @Route("/api/date", name="app_api_date")
     */
    public function index(): Response
    {
        return $this->json($this->repository->findAll(), Response::HTTP_OK, []);
    }
}
