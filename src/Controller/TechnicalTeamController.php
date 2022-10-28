<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class TechnicalTeamController extends AbstractController
{
    #[Route('/technicalteam', name: 'app_technical_team')]
    public function index(): Response
    {
        return $this->render('technical_team/index.html.twig');
    }
}
