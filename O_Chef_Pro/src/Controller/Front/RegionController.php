<?php

namespace App\Controller\Front;

use App\Entity\Region;
use App\Form\RegionType;
use App\Repository\RegionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/region")
 */
class RegionController extends AbstractController
{
    /**
     * @Route("/", name="region_index", methods={"GET"})
     */
    public function index(RegionRepository $regionRepository): Response
    {
        return $this->render('back/region/index.html.twig', [
            'regions' => $regionRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}", name="region_show", methods={"GET"})
     */
    public function show(Region $region): Response
    {
        return $this->render('back/region/show.html.twig', [
            'region' => $region,
        ]);
    }
}
