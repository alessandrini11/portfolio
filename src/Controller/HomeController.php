<?php

namespace App\Controller;

use App\Repository\BackendRepository;
use App\Repository\FrontendRepository;
use App\Repository\ProjectRepository;
use App\Repository\VisitorRepository;
use App\Services\VisitorService;
use GeoIp2\Database\Reader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->redirectToRoute('admin');
    }

    #[Route('/download-cv', name: 'app_cv', methods:['GET'])]
    public function downloadCv(): BinaryFileResponse
    {
        $cvPath = "cv/cv.pdf";
        $headers = array(
            'Content-Type: application/pdf',
        );
        return $this->file($cvPath, 'cv.pdf');
    }
}
