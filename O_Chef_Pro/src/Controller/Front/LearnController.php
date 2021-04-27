<?php

namespace App\Controller\Front;

use App\Entity\Learn;
use App\Form\LearnType;
use App\Repository\LearnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/front/learn")
 */
class LearnController extends AbstractController
{
    /**
     * @Route("/", name="learn_index", methods={"GET"})
     */
    public function index(LearnRepository $learnRepository): Response
    {
        return $this->render('front/learn/index.html.twig', [
            'learns' => $learnRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="learn_show", methods={"GET"})
     */
    public function show(Learn $learn): Response
    {
        return $this->render('front/learn/show.html.twig', [
            'learn' => $learn,
        ]);
    }

}
