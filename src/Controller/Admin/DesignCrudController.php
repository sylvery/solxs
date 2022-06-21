<?php

namespace App\Controller\Admin;

use App\Entity\Design;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DesignCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Design::class;
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
