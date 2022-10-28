<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Repository\PartnerRepository;
use App\Repository\StructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/partner')]
class PartnerConsultController extends AbstractController
{
    #[Route('/partner-consult', name: 'app_partner_consult')]
    public function index(PartnerRepository $partnerRepository, StructureRepository $structureRepository): Response
    {
        return $this->render('partner_consult/index.html.twig', [
            'partners' => $partnerRepository->findAll(),
            'structures' => $structureRepository->findAll(),
        ]);
    }

    #[Route('/partner-consult/{id}', name: 'app_partner_consult_show', methods: ['GET'])]
    public function show(Partner $partner): Response
    {
        return $this->render('partner/show.html.twig', [
            'partner' => $partner,
        ]);
    }

    #[Route('/partner-consult/structure/{id}', name: 'app_partner_consult_structure')]
    public function showStructureDetails(int $id, PartnerRepository $partnerRepository, StructureRepository $structureRepository)
    {
        return $this->render('partner_consult/showStructureDetails.html.twig', [
            'partners' => $partnerRepository->findAll(),
            'structures' => $structureRepository->find($id),
            'id' => $id,
        ]);
    }
}
