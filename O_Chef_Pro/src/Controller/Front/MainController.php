<?php

namespace App\Controller\Front;

use App\Repository\BlogRepository;
use App\Repository\CategoryRepository;
use App\Repository\CountryRepository;
use App\Repository\IngredientRepository;
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
    public function homepage(RecipeRepository $RecipeRepository, BlogRepository $blogRepository, LearnRepository $learnRepository, IngredientRepository $ingredientRepository, CategoryRepository $categoryRepository, CountryRepository $countryRepository): Response
    {
       
        $allRecipe = $RecipeRepository->findAll();
        $allBlog = $blogRepository->findAll();
        $allLearn = $learnRepository->findAll();
        $allCategory= $categoryRepository->findAll();
        $allCountry = $countryRepository->findAll();
        $allIngredient = $ingredientRepository->findAll();
        $oneBlog = $blogRepository->findBy(array('id' => 1));
        $oneRecipe = $RecipeRepository->findBy(array('id' => 1));

        /* dd($oneBlog); */

        return $this->render('front/main/homepage.html.twig', [
                'recipe_list' => $allRecipe,
                'blog_list' => $allBlog,
                'learn_list' => $allLearn,
                'oneBlog' => $oneBlog,
                'oneRecipe' => $oneRecipe,
                'ingredient_list' => $allIngredient,
                'category_list' => $allCategory,
                'country_list' => $allCountry,
            ]);
    }
}