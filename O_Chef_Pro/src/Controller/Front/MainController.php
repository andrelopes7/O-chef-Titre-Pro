<?php

namespace App\Controller\Front;

use App\Repository\BlogRepository;
use App\Repository\LearnRepository;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/")
*/
class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage", methods="GET")
     */
    public function homepage(RecipeRepository $RecipeRepository, BlogRepository $blogRepository, LearnRepository $learnRepository): Response
    {
       
        $allRecipe = $RecipeRepository->findAll();
        $allBlog = $blogRepository->findAll();
        $allLearn = $learnRepository->findAll();

        return $this->render('front/main/homepage.html.twig', [
                'recipe_list' => $allRecipe,
                'blog_list' => $allBlog,
                'learn_list' => $allLearn
            ]);
    }
}