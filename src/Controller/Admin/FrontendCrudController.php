<?php

namespace App\Controller\Admin;

use App\Entity\Frontend;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FrontendCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Frontend::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ImageField::new('icon')
                ->setUploadDir('public/uploads/logos')
                ->setBasePath('uploads/logos'),
            AssociationField::new('projects')
        ];
    }
}
