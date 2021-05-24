<?php

namespace App\Controller;

use App\Entity\Design;
use App\Form\DesignType;
use App\Repository\DesignCategoryRepository;
use App\Repository\DesignRepository;
use DateTime;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/design")
 */
class DesignController extends AbstractController
{
    /**
     * @Route("/", name="design_index", methods={"GET"})
     */
    public function index(DesignRepository $designRepository, DesignCategoryRepository $dcr): Response
    {
        $dcarr = [];
        foreach($dcr->findAll() as $dc) {
            $darr = [];
            foreach ($designRepository->findAll() as $d) {
                if ($d->getCategory() == $dc) {
                    array_push($darr,$d);
                }
            }
            if ($darr != null) {
                array_push($dcarr,['category'=>$dc,'designs'=>$darr]);
            }
        }
        // dump($dcarr); exit;
        return $this->render('design/index.html.twig', [
            'designs' => $dcarr,
            'ds' => $designRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="design_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $design = new Design();
        $form = $this->createForm(DesignType::class, $design);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $design
                ->setUpdatedAt(new DateTime('now', new DateTimeZone('Pacific/Port_Moresby')))
                ->setImageName($design->getImageFile()->getClientOriginalName())
                // ->setImageSize($design->getImageFile()->getImageSize())
            ;
            $design->setImageSize($design->getImageFile()->getSize());
            // dump($form, $design); exit;
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($design);
            $entityManager->flush();

            return $this->redirectToRoute('design_new');
        }

        return $this->render('design/new.html.twig', [
            'design' => $design,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="design_show", methods={"GET"})
     */
    public function show(Design $design): Response
    {
        return $this->render('design/show.html.twig', [
            'design' => $design,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="design_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Design $design): Response
    {
        $form = $this->createForm(DesignType::class, $design);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $design->setUpdatedAt(new DateTime('now', new DateTimeZone('Pacific/Port_Moresby')));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('design_index');
        }

        return $this->render('design/edit.html.twig', [
            'design' => $design,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="design_delete", methods={"POST"})
     */
    public function delete(Request $request, Design $design): Response
    {
        if ($this->isCsrfTokenValid('delete'.$design->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($design);
            $entityManager->flush();
        }

        return $this->redirectToRoute('design_index');
    }
}
