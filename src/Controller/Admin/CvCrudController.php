<?php

namespace App\Controller\Admin;

use App\Entity\Cv;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CvCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cv::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('name')
                ->setUploadDir('public/uploads/cv')
                ->setBasePath('uploads/cv')
                ->setUploadedFileNamePattern('cv.[extension]')
                ,
            DateTimeField::new('createdAt'),
            DateTimeField::new('updatedAt'),
        ];
    }
}
