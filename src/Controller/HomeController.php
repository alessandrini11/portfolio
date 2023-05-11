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
    public function index(Request $request, 
        VisitorService $visitorService, 
        FrontendRepository $frontendRepository, 
        BackendRepository $backendRepository,
        VisitorRepository $visitorRepository
    ): Response
    {
        $ip = $request->getClientIp();
        $visitorService->getVisitorByIp($ip);
        return $this->render('home/index.html.twig', [
            'frontend' => $frontendRepository->findAll(),
            'backend' => $backendRepository->findAll(),
            'visitors' => $visitorRepository->findAll()
        ]);
    }

    #[Route('/projects', name: 'app_project', methods: ['GET'])]
    public function project(ProjectRepository $projectRepository, Request $request, VisitorService $visitorService): Response
    {
        $ip = $request->getClientIp();
        $visitorService->getVisitorByIp($ip);
        return $this->render('home/project.html.twig', [
            'projects' => $projectRepository->findAll()
        ]);
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

    // #[Route('/update-photo', name: 'app_photo', methods: ['POST'])]
    // public function updatePhoto(Request $request): Response
    // {
    //     // dd($request);
    //     dd($request->files->get('photo'));
    //     return $this->redirect('admin');
    // }
}
