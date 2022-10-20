<?php

namespace App\Controller\Admin;

use App\Entity\Visitor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VisitorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Visitor::class;
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
