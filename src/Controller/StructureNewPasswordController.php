<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\StructureNewPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/structure')]
class StructureNewPasswordController extends AbstractController
{
    #[Route('/structure/newpassword/{id}', name: 'app_structure_new_password')] 
    public function newPassword(
        Structure $structure, 
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager
    ): Response
    
    {       
        $form = $this->createForm(StructureNewPasswordType::class, $structure);
        $form->handleRequest($request);

        //Check if from is Submit and valid
        $plainPassword = $form->get('password')->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            $structure->setPassword(
                $userPasswordHasher->hashPassword(
                    $structure,
                    $plainPassword,
                )
            );

            // Save new password
            $entityManager->flush();

            // Redirect to validation page
            return $this->redirectToRoute('app_structure_new_password_validated');
        }

        return $this->render('structure_new_password/newPass.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/structure/newpassword-validated', name: 'app_structure_new_password_validated', methods: 'GET')]
    public function newPasswordValidated(): Response
    {
        return $this->render('structure_new_password/validationPassword.html.twig', []);
    }
}
