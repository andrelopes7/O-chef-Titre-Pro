<?php

namespace App\Controller\Front;

use App\Entity\Diet;
use App\Form\DietType;
use App\Repository\DietRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/diet")
 */
class DietController extends AbstractController
{
    /**
     * @Route("/", name="diet_index", methods={"GET"})
     */
    public function index(DietRepository $dietRepository): Response
    {
        return $this->render('front/diet/index.html.twig', [
            'diets' => $dietRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="diet_show", methods={"GET"})
     */
    public function show(Diet $diet): Response
    {
        return $this->render('front/diet/show.html.twig', [
            'diet' => $diet,
        ]);
    }

}
