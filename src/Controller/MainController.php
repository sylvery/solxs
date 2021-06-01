<?php

namespace App\Controller;

use App\Entity\Design;
use App\Entity\DesignCategory;
use App\Repository\DesignCategoryRepository;
use App\Repository\DesignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DesignRepository $design, DesignCategoryRepository $dc): Response
    {
        return $this->render('main/index.html.twig', [
            'caps' => $design->findBy(['category'=>$dc->find(3)],null,5),
            'shirts' => $design->findBy(['category'=>$dc->find(1)],null,15),
        ]);
    }
}
