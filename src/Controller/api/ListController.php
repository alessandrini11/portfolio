<?php

namespace App\Controller\api;

use App\Repository\BackendRepository;
use App\Repository\FrontendRepository;
use App\Repository\ProjectRepository;
use App\Repository\VisitorRepository;
use App\Services\VisitorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ListController extends AbstractController
{
    #[Route('/front_ends', name: 'api_front_end', methods: 'GET')]
    public function front_end(Request $request, VisitorService $visitorService, FrontendRepository $frontendRepository): JsonResponse
    {
        $ip = $request->getClientIp();
        $visitorService->getVisitorByIp($ip);
        $front_ends = $frontendRepository->findAll();
        $array = [];
        foreach ($front_ends as $front_end){
            $array[] = $front_end->getData();
        }
        return $this->json($array);
    }
    #[Route('/back_ends', name: 'api_back_end', methods: 'GET')]
    public function back_end(Request $request, VisitorService $visitorService, BackendRepository $backendRepository): JsonResponse
    {
        $ip = $request->getClientIp();
        $visitorService->getVisitorByIp($ip);
        $back_ends = $backendRepository->findAll();
        $array = [];
        foreach ($back_ends as $back_end){
            $array[] = $back_end->getData();
        }
        return $this->json($array);
    }

    #[Route('/visitors', name: 'api_visitors', methods: 'GET')]
    public function visitors(VisitorRepository $visitorRepository): JsonResponse
    {
        $visitors = $visitorRepository->findAll();
        return $this->json(count($visitors));
    }
    #[Route('/projects', name: 'api_project', methods: 'GET')]
    public function project(Request $request, VisitorService $visitorService,ProjectRepository $projectRepository): JsonResponse
    {
        $ip = $request->getClientIp();
        $visitorService->getVisitorByIp($ip);
        $projects = $projectRepository->findAll();
        $array = [];
        foreach ($projects as $project){
            $projectArr = [];
            $projectArr[] = $project->getData();
            $front_end_arr = [];
            $back_end_arr = [];
            foreach ($project->getFrontend() as $front_end){
                $front_end_arr['front_ends'][] = $front_end->getData();
            }
            foreach ($project->getBackend() as $back_end){
                $back_end_arr['back_ends'][] = $back_end->getData();
            }
            $combined_arr = array_merge($projectArr[0], $front_end_arr, $back_end_arr);
            $array[] = $combined_arr;
        }
        return $this->json(array_reverse($array));
    }
}