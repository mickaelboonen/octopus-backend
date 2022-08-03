<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArtistRepository;

class ApiArtistController extends AbstractController
{
    /**
     * @Route("/api/artists", name="app_api_artist")
     */
    public function index(ArtistRepository $artistRepository): Response
    {
        $artists = $artistRepository->findAll();
        $artists = $this->json($artists);
        // return $this->render('api_artist/index.html.twig', [
        //     'controller_name' => 'ApiArtistController',
        // ]);
        return new Response($artists, Response::HTTP_OK, []);
    }
}
