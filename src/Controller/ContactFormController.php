<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Entity\Structure;
use App\Entity\Partner;
use App\Form\ContactFormType;
use App\Repository\ContactFormRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    #[Route('admin/contactform/', name: 'app_contact_form_index', methods: ['GET'])]
    public function index(ContactFormRepository $contactFormRepository): Response
    {
        return $this->render('contact_form/index.html.twig', [
            'contact_forms' => $contactFormRepository->findAll(),
        ]);
    }

    #[Route('/contactform/partner/new/{idPartner}', name: 'app_contact_form_partner_new', methods: ['GET', 'POST'])]
    public function new(int $idPartner, Request $request, ContactFormRepository $contactFormRepository, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {
        // Get the Partner
        $emPartner = $doctrine->getRepository(Partner::class)->find($idPartner);
        // Get the Technical team
        $technicalTeam = $emPartner->getTechnicalTeamId();

        $contactForm = new ContactForm();
        $form = $this->createForm(ContactFormType::class, $contactForm);
        $form->handleRequest($request);

        $contactForm->setPartnerId($emPartner);
        $contactForm->setTechnicalTeamId($technicalTeam);
        $entityManager->flush();

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormRepository->add($contactForm, true);

            $this->addFlash(
                'success',
                'Votre message a bien été enregisté. Il sera traité dans les plus brefs délais.'
            );

            // return $this->redirectToRoute('app_contact_form_index', [], Response::HTTP_SEE_OTHER);
            return $this->redirectToRoute('app_partner_consult', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_form/new.html.twig', [
            'contact_form' => $contactForm,
            'form' => $form,
        ]);
    }

    #[Route('/contactform/structure/new/{idStructure}', name: 'app_contact_form_new', methods: ['GET', 'POST'])]
    public function newMessageStructure(int $idStructure, Request $request, ContactFormRepository $contactFormRepository, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {
        // Get the Structure
        $emStructure = $doctrine->getRepository(Structure::class)->find($idStructure);
        // Get the Partner
        $emPartner = $emStructure->getPartnerId();
        // Get the Technical team
        $technicalTeam = $emStructure->getTechnicalTeamId();

        $contactForm = new ContactForm();
        $form = $this->createForm(ContactFormType::class, $contactForm);
        $form->handleRequest($request);

        $contactForm->setStructureId($emStructure);
        $contactForm->setPartnerId($emPartner);
        $contactForm->setTechnicalTeamId($technicalTeam);
        $entityManager->flush();

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormRepository->add($contactForm, true);

            $this->addFlash(
                'success',
                'Votre message a bien été enregisté. Il sera traité dans les plus brefs délais.'
            );

            // return $this->redirectToRoute('app_contact_form_index', [], Response::HTTP_SEE_OTHER);
            return $this->redirectToRoute('app_structure_consult', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_form/new.html.twig', [
            'contact_form' => $contactForm,
            'form' => $form,
        ]);
    }

    #[Route('/contactform/{id}', name: 'app_contact_form_show', methods: ['GET'])]
    public function show(ContactForm $contactForm): Response
    {
        return $this->render('contact_form/show.html.twig', [
            'contact_form' => $contactForm,
        ]);
    }

    // #[Route('admin/contactform/{id}/edit', name: 'app_contact_form_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, ContactForm $contactForm, ContactFormRepository $contactFormRepository): Response
    // {
    //     $form = $this->createForm(ContactFormType::class, $contactForm);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $contactFormRepository->add($contactForm, true);

    //         return $this->redirectToRoute('app_contact_form_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('contact_form/edit.html.twig', [
    //         'contact_form' => $contactForm,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('admin/contactform/{id}', name: 'app_contact_form_delete', methods: ['POST'])]
    public function delete(Request $request, ContactForm $contactForm, ContactFormRepository $contactFormRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactForm->getId(), $request->request->get('_token'))) {
            $contactFormRepository->remove($contactForm, true);
        }

        return $this->redirectToRoute('app_contact_form_index', [], Response::HTTP_SEE_OTHER);
    }
}
