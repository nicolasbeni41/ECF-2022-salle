<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    #[Route('/error', name: 'app_error')]
    public function show(FlattenException $exception): Response
    {
        // return new Response($exception->getStatusCode());

        $message = $exception->getStatusCode();

        if ( $message === 404 || $message === 500 ) {
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
        } elseif ( $message === 403 ) {
            return $this->render('bundles/TwigBundle/Exception/error403.html.twig');
        }

    }
}
