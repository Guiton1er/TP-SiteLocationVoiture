<?php

namespace App\Controller;

use App\Repository\BrandRepository;
use App\Repository\ModelRepository;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VehicleRepository $vehicleRepository): Response
    {
        $vehicles = $vehicleRepository->findAll();

        return $this->render('home/index.html.twig', [
            'vehicles' => $vehicles,
        ]);
    }
}
