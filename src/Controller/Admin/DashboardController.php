<?php

namespace App\Controller\Admin;

use App\Entity\Appuser;
use App\Entity\Customer;
use App\Entity\Design;
use App\Entity\DesignCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $isAdmin = $this->isGranted('ROLE_ADMIN');
        if ($isAdmin) {
        }
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(DesignCrudController::class)->generateUrl());
        return $this->redirectToRoute('home');

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Solxs');
    }

    public function configureCrud(): Crud
    {    
        return Crud::new()
            ->showEntityActionsInlined();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-users', Appuser::class);
        yield MenuItem::linkToCrud('Designs', 'fas fa-list', Design::class);
        yield MenuItem::linkToCrud('Customer', 'fas fa-list', Customer::class);
        yield MenuItem::linkToCrud('Design Category', 'fas fa-list', DesignCategory::class);
        yield MenuItem::linkToUrl('<span class="btn btn-danger">exit</span>', '', '/');
    }
}
