<?php

namespace App\Controller\Admin;

use App\Entity\Diet;
use App\Form\DietType;
use App\Repository\DietRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/diet")
 */
class DietController extends AbstractController
{
    /**
     * @Route("/", name="admin_diet_index", methods={"GET"})
     */
    public function index(DietRepository $dietRepository): Response
    {
        return $this->render('back/diet/index.html.twig', [
            'diets' => $dietRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_diet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $diet = new Diet();
        $form = $this->createForm(DietType::class, $diet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $diet->setCreatedAt(new \datetime());
            $diet->setUpdatedAt(new \datetime());

            $entityManager->persist($diet);
            $entityManager->flush();

            return $this->redirectToRoute('admin_diet_index');
        }

        return $this->render('back/diet/new.html.twig', [
            'diet' => $diet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_diet_show", methods={"GET"})
     */
    public function show(Diet $diet): Response
    {
        return $this->render('back/diet/show.html.twig', [
            'diet' => $diet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_diet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Diet $diet): Response
    {
        $form = $this->createForm(DietType::class, $diet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_diet_index');
        }

        return $this->render('back/diet/edit.html.twig', [
            'diet' => $diet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_diet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Diet $diet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($diet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_diet_index');
    }
}
