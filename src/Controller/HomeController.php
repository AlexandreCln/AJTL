<?php

namespace App\Controller;

use App\Repository\PartnerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PartnerRepository $partnerRepository)
    {
        return $this->render('home/index.html.twig', [
            'partners' => $partnerRepository->findBy([], ['updatedAt' => 'DESC'], 3)
        ]);
    }
}
