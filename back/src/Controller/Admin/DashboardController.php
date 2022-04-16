<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Cart;
use App\Entity\City;
use App\Entity\Country;
use App\Entity\Customer;
use App\Entity\CustomerGroup;
use App\Entity\Failure;
use App\Entity\OrderRepair;
use App\Entity\OrderRepairChat;
use App\Entity\Page;
use App\Entity\PageBlock;
use App\Entity\PageComment;
use App\Entity\PageRedirection;
use App\Entity\Product;
use App\Entity\ProductBrand;
use App\Entity\ProductCategory;
use App\Entity\ProductPriceReparer;
use App\Entity\Promotion;
use App\Entity\Reparer;
use App\Entity\ReparerCompany;
use App\Entity\Setting;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/dashboard.twig', []);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Back');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        
        yield MenuItem::section('Pages');
        yield MenuItem::linkToCrud('Pages', 'fas fa-list', Page::class);
        yield MenuItem::linkToCrud('Page Blocks', 'fas fa-list', PageBlock::class);
        yield MenuItem::linkToCrud('Commentaires de page', 'fas fa-list', PageComment::class);
        // yield MenuItem::linkToCrud('Blocks de Page', 'fas fa-list', PageBlock::class);
        yield MenuItem::linkToCrud('Redirections', 'fas fa-list', PageRedirection::class);
 
        yield MenuItem::section('Produits');
        yield MenuItem::linkToCrud('Produits', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Marques', 'fas fa-list', ProductBrand::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', ProductCategory::class);
        yield MenuItem::linkToCrud('Promotions', 'fas fa-list', Promotion::class);
        
        yield MenuItem::section('Ventes');
        yield MenuItem::linkToCrud('Paniers', 'fas fa-list', Cart::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-list', OrderRepair::class);
        // yield MenuItem::linkToCrud('Commande Chat', 'fas fa-list', OrderRepairChat::class);
        
        yield MenuItem::section('Pannes');
        yield MenuItem::linkToCrud('Types de panne', 'fas fa-list', Failure::class);
        yield MenuItem::linkToCrud('Prix des réparations', 'fas fa-list', ProductPriceReparer::class);
          
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Clients', 'fas fa-list', Customer::class);
        yield MenuItem::linkToCrud('Groupes Clients', 'fas fa-list', CustomerGroup::class);
        yield MenuItem::linkToCrud('Sociétés de Réparation', 'fas fa-list', ReparerCompany::class);
        // yield MenuItem::linkToCrud('Réparateurs', 'fas fa-list', Reparer::class);
        
        yield MenuItem::section('Configuration');
        yield MenuItem::linkToCrud('Pays', 'fas fa-list', Country::class);
        yield MenuItem::linkToCrud('Villes', 'fas fa-list', City::class);
        yield MenuItem::linkToCrud('Addresses', 'fas fa-list', Address::class);
        yield MenuItem::linkToCrud('Paramètres', 'fas fa-list', Setting::class);

    }
}
