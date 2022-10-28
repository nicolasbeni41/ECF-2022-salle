<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\StructureType;
use App\Form\StructureUpdateType;
use App\Repository\StructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

#[Route('/admin/structure')]
class StructureController extends AbstractController
{
    #[Route('/', name: 'app_structure_index', methods: ['GET'])]
    #[Route('/structure/{page}', name: 'app_structure_pagination', methods: ['GET'])]
    public function index(
        StructureRepository $structureRepository,
        int $page = 1,
    ): Response
    {
        $nbStructure = $structureRepository->findStructurePaginationCount();
        return $this->render('structure/index.html.twig', [
            // 'structures' => $structureRepository->findAll(),
            'structures' => $structureRepository->findStructurePagination($page),
            'currentPage' => $page,
            'maxStructure' => $nbStructure > ($page * 10)
        ]);
    }

    #[Route('/new', name: 'app_structure_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StructureRepository $structureRepository, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $structure = new Structure();
        $form = $this->createForm(StructureType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $structureRepository->add($structure, true);

            // encode the password
            $structure->setPassword(
            $userPasswordHasher->hashPassword(
                    $structure,
                    $form->get('password')->getData()
                )
            );

            // If status inactive, Permissions are not allowed
            if ($structure->isActive() == false) {
                $structure->setSellFood(false);
                $structure->setSellDrink(false);
                $structure->setSendNewsletter(false);
                $structure->setScheduleManagement(false);
                $structure->setPrivateLesson(false);

                $this->addFlash(
                    'notice',
                    'Si le status est inactif, aucune permission ne peut être accordée.'
                );
            }

            // If connecting partner status inactive, structure status can not be active
            if ($structure->getPartnerId()->isActive() == false) {
                $structure->setActive(false);

                $this->addFlash(
                    'notice',
                    'Si le statut du partenaire de rattachement est inactif, le statut de la structure ne peut être actif.'
                );
            }

            // Set the role
            $structure->setRoles(['ROLE_STRUCTURE']);
            $entityManager->persist($structure);
            $entityManager->flush();

            // Sending mail
            $structureMail = $structure->getEmail();
            $structurePartner = $structure->getPartnerId()->getEmail();
            $email = (new TemplatedEmail())
                ->from('brunod.dev@gmail.com')
                ->to($structureMail)
                ->cc($structurePartner)
                ->subject('Création de votre compte SportClub - '.(new \DateTime())->format('d m Y'))
                ->htmlTemplate('mail/creationStructureAccountMail.html.twig')
                ->context([
                    'newsletter_date' => new \DateTime(),
                    'structure' => $structure,
                ])
            ;
            $mailer->send($email);

            return $this->redirectToRoute('app_structure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structure/new.html.twig', [
            'structure' => $structure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_structure_show', methods: ['GET'])]
    public function show(Structure $structure): Response
    {
        return $this->render('structure/show.html.twig', [
            'structure' => $structure,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_structure_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Structure $structure, StructureRepository $structureRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $form = $this->createForm(StructureUpdateType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $structureRepository->add($structure, true);

            // If status inactive, Permissions are not allowed
            if ($structure->isActive() == false) {
                $structure->setSellFood(false);
                $structure->setSellDrink(false);
                $structure->setSendNewsletter(false);
                $structure->setScheduleManagement(false);
                $structure->setPrivateLesson(false);

                $this->addFlash(
                    'notice',
                    'Si le statut est inactif, aucune permission ne peut être accordée.'
                );
            }

            // If connecting partner status inactive, structure status can not be active
            if ($structure->getPartnerId()->isActive() == false) {
                $structure->setActive(false);

                $this->addFlash(
                    'notice',
                    'Si le statut du partenaire de rattachement est inactif, le statut de la structure ne peut être actif.'
                );
            }

            $entityManager->flush();

            // Sending mail
            $structureMail = $structure->getEmail();
            $structurePartner = $structure->getPartnerId()->getEmail();
            $email = (new TemplatedEmail())
                ->from('brunod.dev@gmail.com')
                ->to($structureMail)
                ->cc($structurePartner)
                ->subject('Information compte SportClub - '.(new \DateTime())->format('d m Y'))
                ->htmlTemplate('mail/updateStructureAccountMail.html.twig')
                ->context([
                    'newsletter_date' => new \DateTime(),
                    'structure' => $structure,
                ])
            ;
            $mailer->send($email);


            return $this->redirectToRoute('app_structure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structure/edit.html.twig', [
            'structure' => $structure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_structure_delete', methods: ['POST'])]
    public function delete(Request $request, Structure $structure, StructureRepository $structureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$structure->getId(), $request->request->get('_token'))) {
            $structureRepository->remove($structure, true);
        }

        return $this->redirectToRoute('app_structure_index', [], Response::HTTP_SEE_OTHER);
    }
}
