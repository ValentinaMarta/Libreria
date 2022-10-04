<?php

namespace App\Controller;

use App\Entity\Editorial;
use App\Form\Editorial1Type;
use App\Repository\EditorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/editorial')]
class EditorialController extends AbstractController
{
    #[Route('/', name: 'app_editorial_index', methods: ['GET'])]
    public function index(EditorialRepository $editorialRepository): Response
    {
        return $this->render('editorial/index.html.twig', [
            'editorials' => $editorialRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_editorial_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EditorialRepository $editorialRepository): Response
    {
        $editorial = new Editorial();
        $form = $this->createForm(Editorial1Type::class, $editorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $editorialRepository->save($editorial, true);

            return $this->redirectToRoute('app_editorial_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('editorial/new.html.twig', [
            'editorial' => $editorial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_editorial_show', methods: ['GET'])]
    public function show(Editorial $editorial): Response
    {
        return $this->render('editorial/show.html.twig', [
            'editorial' => $editorial,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_editorial_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Editorial $editorial, EditorialRepository $editorialRepository): Response
    {
        $form = $this->createForm(Editorial1Type::class, $editorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $editorialRepository->save($editorial, true);

            return $this->redirectToRoute('app_editorial_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('editorial/edit.html.twig', [
            'editorial' => $editorial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_editorial_delete', methods: ['POST'])]
    public function delete(Request $request, Editorial $editorial, EditorialRepository $editorialRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$editorial->getId(), $request->request->get('_token'))) {
            $editorialRepository->remove($editorial, true);
        }

        return $this->redirectToRoute('app_editorial_index', [], Response::HTTP_SEE_OTHER);
    }
}
