<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\CustomerOrder;
use App\Form\CustomerOrderType;
use App\Repository\CustomerOrderRepository;
use App\Repository\DesignRepository;
use DateTime;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;

/**
 * @Route("/order")
 */
class CustomerOrderController extends AbstractController
{
    private $wfr;
    public function __construct(Registry $wfr)
    {
        $this->wfr = $wfr;
    }

    /**
     * @Route("/", name="customer_order_index", methods={"GET"})
     */
    public function index(CustomerOrderRepository $customerOrderRepository): Response
    {
        $cusOrders = $customerOrderRepository->findAll();
        $drafted = [];
        $ordered = [];
        $designed = [];
        $printed = [];
        $delivered = [];
        foreach ($cusOrders as $order) {
            $wf = $this->wfr->get($order);
            $currentPlace = key($wf->getMarking($order)->getPlaces());
            // dump($currentPlace); exit;
            switch ($currentPlace) {
                case 'ordered':
                    array_push($ordered, $order);
                    break;
                case 'designed':
                    array_push($designed, $order);
                    break;
                case 'printed':
                    array_push($printed, $order);
                    break;
                case 'delivered':
                    array_push($delivered, $order);
                    break;
                default:
                    array_push($drafted, $order);
                    break;
            }
        }
        // dump($designed); exit;
        return $this->render('customer_order/index.html.twig', [
            'customer_orders' => $customerOrderRepository->findAll(),
            'drafted' => $drafted,
            'ordered' => $ordered,
            'designed' => $designed,
            'printed' => $printed,
            'delivered' => $delivered,
        ]);
    }

    /**
     * @Route("/new", name="customer_order_new", methods={"GET","POST"})
     */
    public function new(Request $request, DesignRepository $designRepository): Response
    {
        $customerOrder = new CustomerOrder();
        $form = $this->createForm(CustomerOrderType::class, $customerOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerOrder->setDateordered(new DateTime($customerOrder->getDateordered(), new DateTimeZone('Pacific/Port_Moresby')));
            $workflow = $this->wfr->get($customerOrder, 'orders');
            if($workflow->can($customerOrder, 'to_order')) {
                $workflow->apply($customerOrder, 'to_order');
                // $customerOrder->setDateordered(new DateTime('now', new DateTimeZone('Pacific/Port_Moresby')));
            }
            $customerOrder->setUpdatedAt(new DateTime('now', new DateTimeZone('Pacific/Port_Moresby')));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($customerOrder);
            $entityManager->flush();

            return $this->redirectToRoute('customer_order_index');
        }

        return $this->render('customer_order/new.html.twig', [
            'customer_order' => $customerOrder,
            'designs' => $designRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="customer_order_show", methods={"GET"})
     */
    public function show(CustomerOrder $customerOrder): Response
    {
        return $this->render('customer_order/show.html.twig', [
            'customer_order' => $customerOrder,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="customer_order_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CustomerOrder $customerOrder): Response
    {
        $form = $this->createForm(CustomerOrderType::class, $customerOrder);
        $form->handleRequest($request);

        $workflow = $this->wfr->get($customerOrder,'orders');
        
        if ($form->isSubmitted() && $form->isValid()) {
            if ($workflow->can($customerOrder, 'to_order')) {
                $workflow->apply($customerOrder, 'to_order');
            } else if ($workflow->can($customerOrder, 'to_design')) {
                $workflow->apply($customerOrder, 'to_design');
            } else if ($workflow->can($customerOrder, 'to_print')) {
                $workflow->apply($customerOrder, 'to_print');
            } else if ($workflow->can($customerOrder, 'to_deliver')) {
                $workflow->apply($customerOrder, 'to_deliver');
                $customerOrder->setStatus(true);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('customer_order_show',['id' => $customerOrder->getId()]);
        }

        return $this->render('customer_order/edit.html.twig', [
            'customer_order' => $customerOrder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="customer_order_delete", methods={"POST"})
     */
    public function delete(Request $request, CustomerOrder $customerOrder): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customerOrder->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($customerOrder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('customer_order_index');
    }
}
