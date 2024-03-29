<?php

namespace App\Controller\Admin;

use App\Entity\Backend;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BackendCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Backend::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ImageField::new('icon')
                ->setUploadDir('public/uploads/logos')
                ->setBasePath('uploads/logos')
                ->setUploadedFileNamePattern('[day][uuid].[extension]'),
            AssociationField::new('projects')->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }
    
}
