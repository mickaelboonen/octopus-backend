<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PhotoRepository;

class ApiPictureController extends AbstractController
{

    
    private $repository;

    public function __construct(PhotoRepository $pictureRepository )
    {
        $this->repository = $pictureRepository;
    }
    

    /**
     * @Route("/api/pictures/{id}", name="app_api_picture_id")
     */
    public function index(int $id): Response
    {
        return $this->json($this->repository->findByPlay($id), Response::HTTP_OK, []);
    }
}
