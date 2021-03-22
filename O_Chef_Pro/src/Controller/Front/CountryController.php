<?php

namespace App\Controller\Front;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/country")
 */
class CountryController extends AbstractController
{
    /**
     * @Route("/", name="country_index", methods={"GET"})
     */
    public function index(CountryRepository $countryRepository): Response
    {
        return $this->render('front/country/index.html.twig', [
            'countries' => $countryRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}", name="country_show", methods={"GET"})
     */
    public function show(Country $country): Response
    {
        return $this->render('front/country/show.html.twig', [
            'country' => $country,
        ]);
    }

}
