<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Route("/admin/recipe")
 * @Vich\Uploadable
 */
class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="admin_recipe_index", methods={"GET"})
     */
    public function index(RecipeRepository $recipeRepository): Response
    {
        return $this->render('back/recipe/index.html.twig', [
            'recipes' => $recipeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_recipe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $recipe->setCreatedAt(new \datetime());
            $recipe->setUpdatedAt(new \datetime());

            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('admin_recipe_index');
        }

        return $this->render('back/recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_recipe_show", methods={"GET"})
     */
    public function show(Recipe $recipe): Response
    {
        return $this->render('back/recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_recipe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Recipe $recipe, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();

                $recipe->setUpdatedAt(new \DateTime());
                $em->flush();

            return $this->redirectToRoute('admin_recipe_index');
        }

        return $this->render('back/recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_recipe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Recipe $recipe): Response
    {

        // vérification du token généré dans twig par la fonction csrf_token
        $tokenFromForm = $request->request->get('_token');

        // ceci est la clef qui nous a permis de généré le token
         $tokenKey = 'delete-recipe' . $recipe->getId(); 

         if ($this->isCsrfTokenValid($tokenKey, $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_recipe_index');
    }
}
