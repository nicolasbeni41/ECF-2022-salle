<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteMapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'app_sitemap', defaults: ['_format' => 'xml'])]
    public function index(Request $request)
    {
        // Get hostname
        $hostname = $request->getSchemeAndHttpHost();

        // Create urls
        $urls = [];

        $urls[] = ['loc' => $this->generateUrl('app_home')];
        $urls[] = ['loc' => $this->generateUrl('app_technical_team')];
        $urls[] = ['loc' => $this->generateUrl('app_partner_index')];
        $urls[] = ['loc' => $this->generateUrl('app_partner_consult')];
        $urls[] = ['loc' => $this->generateUrl('app_structure_index')];
        $urls[] = ['loc' => $this->generateUrl('app_structure_consult')];
        $urls[] = ['loc' => $this->generateUrl('app_contact_form_index')];
        $urls[] = ['loc' => $this->generateUrl('app_legales')];
        $urls[] = ['loc' => $this->generateUrl('app_search')];
        $urls[] = ['loc' => $this->generateUrl('app_login')];
        $urls[] = ['loc' => $this->generateUrl('app_logout')];

        $response = new Response(
            $this->renderView('siteMap/index.html.twig', [
            'urls' => $urls,
            'hostname' => $hostname
            ]),
            200
        );

        $response->headers->set('Content-type', 'text/xml');
        return $response;
    }
    }