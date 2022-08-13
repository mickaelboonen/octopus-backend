<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArtistRepository;

class ApiArtistController extends AbstractController
{

    
    private $repository;

    public function __construct(ArtistRepository $tagRepository )
    {
        $this->repository = $tagRepository;
    }
    /**
     * @Route("/all", name="all", methods={"GET"})
     */
    public function getAllTags(): Response
    {

        //I return Tags and status code
        return $this->json($this->repository->findAll(), Response::HTTP_OK, [], [
            'groups' => ['api_tags_all']
        ]);
    }

    /**
     * @Route("/api/artists", name="app_api_artist")
     */
    public function index(): Response
    {
        return $this->json($this->repository->findAll(), Response::HTTP_OK, []);
    }

    /**
     * @Route("/api/artists/is_former", name="app_api_artist_isformer")
     */
    public function getFormerArtists(): Response
    {
        return $this->json($this->repository->findByIsFormer(), Response::HTTP_OK, []);
    }
}
