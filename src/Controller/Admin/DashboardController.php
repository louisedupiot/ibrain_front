<?php

namespace App\Controller\Admin;

use App\Entity\Abonnement;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }




    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // $url = $this->adminUrlGenerator->setController(UserCrudController::class)
        // ->generateUrl();
        // return $this->redirect($url);

        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(CategoryCrudController::class)->generateUrl();
        return $this->redirect($url);




        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

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
            ->setTitle('Ibrain Front');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Users', 'fa fa-user');

        yield   MenuItem::linkToCrud('Create Users', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW);
        yield  MenuItem::linkToCrud('Show Users', 'fas fa-eye', User::class);


        yield MenuItem::section('Categories', "fa-solid fa-list-check");

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Category', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Categories', 'fas fa-eye', Category::class)
        ]);

        yield MenuItem::section('Products', "fa-solid tag");
        yield MenuItem::subMenu('Actions', 'fas fa-tag')->setSubItems([
            MenuItem::linkToCrud('Create Product', 'fas fa-plus', Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Product', 'fas fa-eye', Product::class)
        ]);

        yield MenuItem::section('Commande', "fa-solid tag");
        yield MenuItem::subMenu('Actions', 'fas fa-tag')->setSubItems([
            MenuItem::linkToCrud('Create Commande', 'fas fa-plus', Order::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Commande', 'fas fa-eye', Order::class)
        ]);

        yield MenuItem::section('Abonnement', "fa-solid tag");
        yield MenuItem::subMenu('Actions', 'fas fa-tag')->setSubItems([
            MenuItem::linkToCrud('Create Abonnement', 'fas fa-plus', Abonnement::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Abonnement', 'fas fa-eye', Abonnement::class)
        ]);




        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
