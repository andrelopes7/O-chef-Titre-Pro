<?php

namespace App\Controller\Admin;

use App\Entity\Learn;
use App\Form\LearnType;
use App\Repository\LearnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/learn")
 */
class LearnController extends AbstractController
{
    /**
     * @Route("/", name="admin_learn_index", methods={"GET"})
     */
    public function index(LearnRepository $learnRepository): Response
    {
        return $this->render('back/learn/index.html.twig', [
            'learns' => $learnRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_learn_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $learn = new Learn();
        $form = $this->createForm(LearnType::class, $learn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($learn);
            $entityManager->flush();

            return $this->redirectToRoute('admin_learn_index');
        }

        return $this->render('back/learn/new.html.twig', [
            'learn' => $learn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_learn_show", methods={"GET"})
     */
    public function show(Learn $learn): Response
    {
        return $this->render('back/learn/show.html.twig', [
            'learn' => $learn,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_learn_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Learn $learn): Response
    {
        $form = $this->createForm(LearnType::class, $learn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_learn_index');
        }

        return $this->render('back/learn/edit.html.twig', [
            'learn' => $learn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_learn_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Learn $learn): Response
    {
        if ($this->isCsrfTokenValid('delete'.$learn->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($learn);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_learn_index');
    }
}
