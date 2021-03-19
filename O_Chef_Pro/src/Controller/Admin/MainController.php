<?php

namespace App\Controller\Admin;


use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/admin")
*/
class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage", methods="GET")
     */
    public function homepage(RecipeRepository $RecipeRepository): Response
    {
       
        $allRecipe= $RecipeRepository->findBy([], ['name' => 'ASC']);
        return $this->render('back/main/homepage.html.twig', [
                'recipe_list' => $allRecipe,
            ]);
    }
}