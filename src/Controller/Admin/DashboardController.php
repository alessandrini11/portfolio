<?php

namespace App\Controller\Admin;

use App\Entity\Backend;
use App\Entity\Cv;
use App\Entity\Frontend;
use App\Entity\Project;
use App\Entity\User;
use App\Entity\Visitor;
use App\Repository\VisitorRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private VisitorRepository $visitorRepository;
    public function __construct(VisitorRepository $visitorRepository)
    {
        $this->visitorRepository = $visitorRepository;
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'visitors' => $this->visitorRepository->findAll()
        ]);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('build/app.css');
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Projects', 'fas fa-cogs', Project::class);
        yield MenuItem::linkToCrud('Cv', 'fas fa-file', Cv::class);
        yield MenuItem::linkToCrud('Front End', 'fas fa-palette', Frontend::class);
        yield MenuItem::linkToCrud('Back End', 'fas fa-code', Backend::class);
        yield MenuItem::linkToCrud('Visitors', 'fas fa-users', Visitor::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
    }
}
