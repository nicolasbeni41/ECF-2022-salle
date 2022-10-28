<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Form\PartnerUpdateType;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

#[Route('/admin/partner')]
class PartnerController extends AbstractController
{
    #[Route('/', name: 'app_partner_index', methods: ['GET'])]
    #[Route('/partner/{page}', name: 'app_partner_pagination', methods: ['GET'])]
    public function index(
        PartnerRepository $partnerRepository,
        int $page = 1,
    ): Response
    {
        $nbPartner = $partnerRepository->findPartnerPaginationCount();
        return $this->render('partner/index.html.twig', [
            // 'partners' => $partnerRepository->findAll(),
            'partners' => $partnerRepository->findPartnerPagination($page),
            'currentPage' => $page,
            'maxPartner' => $nbPartner > ($page * 10)
        ]);
    }

    #[Route('/new', name: 'app_partner_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PartnerRepository $partnerRepository, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $partner = new Partner();
        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $partnerRepository->add($partner, true);

            // encode the password
            $partner->setPassword(
            $userPasswordHasher->hashPassword(
                    $partner,
                    $form->get('password')->getData()
                )
            );

            // If status inactive, Permissions are not allowed
            if ($partner->isActive() == false) {
                $partner->setSellFood(false);
                $partner->setSellDrink(false);
                $partner->setSendNewsletter(false);
                $partner->setScheduleManagement(false);
                $partner->setPrivateLesson(false);

                $this->addFlash(
                    'notice',
                    'Si le statut est inactif, aucune permission ne peut être accordée.'
                );
            }

            // set the role
            $partner->setRoles(['ROLE_PARTNER']);
            $entityManager->persist($partner);
            $entityManager->flush();

            // Sending mail
            $partnerMail = $partner->getEmail();
            $email = (new TemplatedEmail())
                ->from('brunod.dev@gmail.com')
                ->to($partnerMail)
                ->subject('Création de votre compte SportClub - '.(new \DateTime())->format('d m Y'))
                ->htmlTemplate('mail/creationPartnerAccountMail.html.twig')
                ->context([
                    'newsletter_date' => new \DateTime(),
                    'partner' => $partner,
                ])
            ;
            $mailer->send($email);

            return $this->redirectToRoute('app_partner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('partner/new.html.twig', [
            'partner' => $partner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partner_show', methods: ['GET'])]
    public function show(Partner $partner): Response
    {
        return $this->render('partner/show.html.twig', [
            'partner' => $partner,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_partner_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Partner $partner, PartnerRepository $partnerRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $form = $this->createForm(PartnerUpdateType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $partnerRepository->add($partner, true);

            // If status inactive, Permissions are not allowed
            if ($partner->isActive() == false) {
                $partner->setSellFood(false);
                $partner->setSellDrink(false);
                $partner->setSendNewsletter(false);
                $partner->setScheduleManagement(false);
                $partner->setPrivateLesson(false);

                $this->addFlash(
                    'notice',
                    'Si le statut est inactif, aucune permission ne peut être accordée.'
                );
            }

            $entityManager->flush();

            // Sending mail
            $partnerMail = $partner->getEmail();
            $email = (new TemplatedEmail())
                ->from('brunod.dev@gmail.com')
                ->to($partnerMail)
                ->subject('Information compte SportClub - '.(new \DateTime())->format('d m Y'))
                ->htmlTemplate('mail/updatePartnerAccountMail.html.twig')
                ->context([
                    'newsletter_date' => new \DateTime(),
                    'partner' => $partner,
                ])
            ;
            $mailer->send($email);

            return $this->redirectToRoute('app_partner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('partner/edit.html.twig', [
            'partner' => $partner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partner_delete', methods: ['POST'])]
    public function delete(Request $request, Partner $partner, PartnerRepository $partnerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partner->getId(), $request->request->get('_token'))) {
            $partnerRepository->remove($partner, true);
        }

        return $this->redirectToRoute('app_partner_index', [], Response::HTTP_SEE_OTHER);
    }
}
