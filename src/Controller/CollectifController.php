<?php

namespace App\Controller;

use App\Entity\Collectif;
use App\Form\CollectifType;
use App\Repository\CollectifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/collectif")
 */
class CollectifController extends AbstractController
{
    /**
     * @Route("/", name="app_collectif_index", methods={"GET"})
     */
    public function index(CollectifRepository $collectifRepository): Response
    {
        return $this->render('collectif/index.html.twig', [
            'collectifs' => $collectifRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_collectif_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CollectifRepository $collectifRepository): Response
    {
        $collectif = new Collectif();
        $form = $this->createForm(CollectifType::class, $collectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $collectifRepository->add($collectif, true);

            return $this->redirectToRoute('app_collectif_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collectif/new.html.twig', [
            'collectif' => $collectif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_collectif_show", methods={"GET"})
     */
    public function show(Collectif $collectif): Response
    {
        return $this->render('collectif/show.html.twig', [
            'collectif' => $collectif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_collectif_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Collectif $collectif, CollectifRepository $collectifRepository): Response
    {
        $form = $this->createForm(CollectifType::class, $collectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $collectifRepository->add($collectif, true);

            return $this->redirectToRoute('app_collectif_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collectif/edit.html.twig', [
            'collectif' => $collectif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_collectif_delete", methods={"POST"})
     */
    public function delete(Request $request, Collectif $collectif, CollectifRepository $collectifRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collectif->getId(), $request->request->get('_token'))) {
            $collectifRepository->remove($collectif, true);
        }

        return $this->redirectToRoute('app_collectif_index', [], Response::HTTP_SEE_OTHER);
    }
}
