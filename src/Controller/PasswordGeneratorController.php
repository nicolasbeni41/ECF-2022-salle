<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PasswordGeneratorController extends AbstractController
{
    #[Route('/passwordgenerator', name: 'app_password_generator')]
    public function index(): Response
    {

        $allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array();
        $allowedCharactersLen = strlen($allowedCharacters) - 1;
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $allowedCharactersLen);
            $password[] = $allowedCharacters[$n];
        }
        
        // To convert an array to string
        $password = implode($password);

        return $this->render('password_generator/index.html.twig', [
            'password' => $password,
        ]);
    }
}
