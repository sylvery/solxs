<?php

namespace App\Controller\Admin;

use App\Entity\DesignCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DesignCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DesignCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Design Categories')
            ->setEntityLabelInSingular('Category')
            ->setEntityLabelInPlural('Categories')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title');
        $description = TextareaField::new('description');
        if (Crud::PAGE_INDEX == $pageName) {
            return [$title];
        }
        return [$title, $description];
    }
}
