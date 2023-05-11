<?php

namespace App\Controller\Admin;

use App\Entity\Cv;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CvCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cv::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
