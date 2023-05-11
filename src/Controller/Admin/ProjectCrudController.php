<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Services\UploadFilesService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\BatchActionDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Symfony\Component\HttpFoundation\Response;

class ProjectCrudController extends AbstractCrudController
{
    private UploadFilesService $uploadFilesService;
    public function __construct(UploadFilesService $uploadFilesService)
    {
        $this->uploadFilesService = $uploadFilesService;
    }
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            UrlField::new('url'),
            ImageField::new('image')
                ->setRequired(false)
                ->setUploadDir('public/uploads/projects')
                ->setBasePath('uploads/projects')
                ->setUploadedFileNamePattern('[day][uuid].[extension]'),
            AssociationField::new('frontend')
                ->setFormTypeOption('by_reference', false),
            AssociationField::new('backend')
                ->setFormTypeOption('by_reference', false),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->uploadFilesService->removeFile($entityInstance->getImage());
        parent::deleteEntity($entityManager, $entityInstance);
    }

    public function batchDelete(AdminContext $context, BatchActionDto $batchActionDto): Response
    {
        $entityManager = $this->container->get('doctrine')->getManagerForClass($batchActionDto->getEntityFqcn());
        $repository = $entityManager->getRepository($batchActionDto->getEntityFqcn());
        foreach ($batchActionDto->getEntityIds() as $id) {
            $project = $repository->find($id);
            if (!$project) {
                continue;
            }
            $photo = $project->getImage();
            $this->uploadFilesService->removeFile($photo);
            parent::deleteEntity($entityManager, $project);
        }
        return $this->redirect($batchActionDto->getReferrerUrl());
    }
}
