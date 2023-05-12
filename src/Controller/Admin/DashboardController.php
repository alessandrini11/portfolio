<?php

namespace App\Controller\Admin;

use App\Entity\Backend;
use App\Entity\Cv;
use App\Entity\Frontend;
use App\Entity\Project;
use App\Entity\User;
use App\Entity\Visitor;
use App\Repository\ProjectRepository;
use App\Repository\VisitorRepository;
use App\Services\VisitorService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        readonly private VisitorRepository $visitorRepository,
        readonly private VisitorService $visitorService,
        readonly private ProjectRepository $projectRepository,
        readonly private ChartBuilderInterface $chartBuilder
    )
    {

    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $chart = $this->createChart($this->visitorService->getVisitorGroupedByCountry($this->visitorRepository));
        return $this->render('admin/dashboard.html.twig', [
            'visitors' => $this->visitorRepository->findAll(),
            'projects' => $this->projectRepository->findAll(),
            'chart' => $chart,
        ]);
    }
    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addWebpackEncoreEntry('app')
            ;
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
    private function createChart(array $data): Chart
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => $data['labels'],
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(109, 40, 217)',
                    'data' => $data['data'],
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                ],
            ],
        ]);
        return $chart;
    }
}
