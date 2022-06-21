<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $fullname = TextField::new('fullname', 'Full Name');
        $location = TextField::new('location');
        $phoneNumber = TextField::new('phoneNumber');
        $customerOrders = AssociationField::new('customerOrders');
        if (Crud::PAGE_INDEX == $pageName) {
            return [$fullname, $customerOrders];
        }
        return [$fullname, $location, $phoneNumber];
    }
}
