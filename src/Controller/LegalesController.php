<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalesController extends AbstractController
{
    #[Route('/legales', name: 'app_legales')]
    public function index(): Response
    {
        return $this->render('legales/index.html.twig');
    }
}
