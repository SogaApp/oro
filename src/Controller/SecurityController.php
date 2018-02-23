<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Forms\Type\FormTypeLogin;
use Symfony\Component\Security\Core\SecurityContext;


class SecurityController extends Controller
{
    /**
     * @Route("/acceso", name="acceso")
     */
    public function accesoAction(Request $request){


        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('App:Login:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));

//        $form = $this->createForm(FormTypeLogin::class, null, array(
//            'action' => $this->generateUrl("acceso"),
//            )
//        );
//
//        $form->handleRequest($request);
//
//        // replace this example code with whatever you need
//        return $this->render('App:Login:login.html.twig', [
//            'form' => $form->createView(),
//        ]);
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction(){
        throw new \RuntimeException('Esta funcion jamas debe ser llamada directamente');
    }



    /**
     * @Route("/acceso2", name="acceso2")
     */
    public function acceso2Action(Request $request){


       
      return $this->render('App:Login:login2.html.twig');

    }    

}
