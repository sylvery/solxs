<?php

namespace App\Controller;

use App\Entity\Appuser;
use App\Entity\Design;
use App\Entity\DesignCategory;
use App\Form\AppuserType;
use App\Repository\DesignCategoryRepository;
use App\Repository\DesignRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\UserPassportInterface;

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

    /**
     * @Route("/register", name="register_user")
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     */
    public function register(Request $request, UserPasswordEncoderInterface $upi)
    {
        $user = new Appuser();
        $form = $this->createForm(AppuserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setPassword($upi->encodePassword($user,$user->getPassword()));
            if ($user->getId() === 1 || $user->getId() === 2 || $user->getId() === 3) {
                $user->setRoles(['ROLE_ADMIN'=>'ROLE_ADMIN']);
            }
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('appuser/new.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
