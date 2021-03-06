<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Route("/admin/ingredient")
 * @Vich\Uploadable
 */
class IngredientController extends AbstractController
{
    /**
     * @Route("/", name="admin_ingredient_index", methods={"GET"})
     */
    public function index(IngredientRepository $ingredientRepository, TypeRepository $typeRepository): Response
    {
        return $this->render('back/ingredient/index.html.twig', [
            'ingredients' => $ingredientRepository->findAll(),
            'types' => $typeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_ingredient_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $ingredient->setCreatedAt(new \datetime());
            $ingredient->setUpdatedAt(new \datetime());

            $entityManager->persist($ingredient);
            $entityManager->flush();

            return $this->redirectToRoute('admin_ingredient_index');
        }

        return $this->render('back/ingredient/new.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_ingredient_show", methods={"GET"})
     */
    public function show(Ingredient $ingredient): Response
    {
        return $this->render('back/ingredient/show.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_ingredient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ingredient $ingredient): Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();       
            $em->persist($ingredient);
            $em->flush();


            return $this->redirectToRoute('admin_ingredient_index');
        }

        return $this->render('back/ingredient/edit.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_ingredient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ingredient $ingredient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ingredient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_ingredient_index');
    }
}
