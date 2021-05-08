<?php

namespace App\Controller;

use App\Entity\DesignCategory;
use App\Form\DesignCategoryType;
use App\Repository\DesignCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/design-category")
 */
class DesignCategoryController extends AbstractController
{
    /**
     * @Route("/", name="design_category_index", methods={"GET"})
     */
    public function index(DesignCategoryRepository $designCategoryRepository): Response
    {
        return $this->render('design_category/index.html.twig', [
            'design_categories' => $designCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="design_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $designCategory = new DesignCategory();
        $form = $this->createForm(DesignCategoryType::class, $designCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($designCategory);
            $entityManager->flush();

            return $this->redirectToRoute('design_category_index');
        }

        return $this->render('design_category/new.html.twig', [
            'design_category' => $designCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="design_category_show", methods={"GET"})
     */
    public function show(DesignCategory $designCategory): Response
    {
        return $this->render('design_category/show.html.twig', [
            'design_category' => $designCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="design_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DesignCategory $designCategory): Response
    {
        $form = $this->createForm(DesignCategoryType::class, $designCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('design_category_index');
        }

        return $this->render('design_category/edit.html.twig', [
            'design_category' => $designCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="design_category_delete", methods={"POST"})
     */
    public function delete(Request $request, DesignCategory $designCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$designCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($designCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('design_category_index');
    }
}
