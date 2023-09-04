<?php

namespace App\Controller\Admin;

use App\Entity\Design;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DesignCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Design::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $description = TextField::new('description');
        return [
            $name, $description,
        ];
    }
}
