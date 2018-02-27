<?php

namespace App\Controller;

use App\Entity\Caso;
use App\Entity\Cliente;
use App\Forms\Type\FormTypeCaso;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Llamada;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\SwiftmailerBundle;

class CasoController extends Controller {

    var $strDqlLista = '';

    /**
     * @Route("/caso/nuevo/{codigoCaso}", requirements={"codigoCaso":"\d+"}, name="registrarCaso")
     */
    public function nuevo(Request $request, $codigoCaso = null) {
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
//      $user = $this->getUser(); // trae el usuario actual
        $arCaso = new Caso(); //instance class

        if($codigoCaso) {
            $arCaso = $em->getRepository('App:Caso')->find($codigoCaso);
        } else {
            $arCaso->setEstadoAtendido(false);
            $arCaso->setEstadoSolucionado(false);
        }

        $form = $this->createForm(FormTypeCaso::class, $arCaso); //create form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $arCaso->setCodigoUsuarioAtiendeFk($user->getCodigoUsuarioPk());
            if(!$codigoCaso) {
                $arCaso->setFechaRegistro(new \DateTime('now'));
            }
            $em->persist($arCaso);
            $em->flush();
            return $this->redirect($this->generateUrl('listadoCasosSinSolucionar'));
        }

        return $this->render('Caso/nuevo.html.twig',
            array(
                'form' => $form->createView(),
            ));
    }

    /**
     * @Route("/caso/solucion/registrar/{codigoCaso}",requirements={"codigoCaso":"\d+"}, name="registrarSolucion")
     */
    public function registrarSolucion(Request $request, $codigoCaso = null,  \Swift_Mailer $mailer )
    {
        /**
         * @var $arCaso Caso
         */
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $arCaso = $em->getRepository('App:Caso')->find($codigoCaso);
        $user = $this->getUser()->getCodigoUsuarioPk();

        $form = $this->createFormBuilder()
        ->add ('solucion', TextareaType::class,array(
            'attr' => array(
                'id' => '_solucion',
                'name' => '_solucion',
                'class' => 'form-control'
            )
        ))
        ->add ('btnGuardar', SubmitType::class, array(
            'attr' => array(
                'id' => '_btnGuardar',
                'name' => '_btnGuardar'
            ), 'label' => 'GUARDAR'
        ))
        ->getForm();
//        $form = $this->createForm(FormTypeCaso::class, $arCaso); //create form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arCaso->setCodigoUsuarioSolucionaFk($user);
            $arCaso->setEstadoAtendido(true);
            $arCaso->setEstadoSolucionado(true);
            $arCaso->setSolucion($form->get('solucion')->getData());
            $em->persist($arCaso);
            $em->flush();

            $message = (new \Swift_Message('Solución de caso - AppSoga'.' - '.$arCaso->getCodigoCasoPk()))
            ->setFrom('sogainformacion@gmail.com')
                ->setTo($arCaso->getCorreo())
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'Correo/Caso/solucionado.html.twig',
                        array('arCaso' => $arCaso)
                    ),
                    'text/html'
                )
                /*
                 * If you also want to include a plaintext version of the message
                ->addPart(
                    $this->renderView(
                        'emails/registration.txt.twig',
                        array('name' => $name)
                    ),
                    'text/plain'
                )
                */
            ;

            $mailer->send($message);
//
//            $this->enviarCorreo($arCaso);

            echo "<script>window.opener.location.reload();window.close()</script>";
        }

        return $this->render('Caso/solucion.html.twig', [
            'form' => $form->createView(),
            'arCaso' => $arCaso
        ]);


    }


    /**
     * @Route("/caso/lista/sin/solucionar", name="listadoCasosSinSolucionar")
     */

    public function listaSinSolucionar(Request $request, Request $requestFiltro) {
        $em = $this->getDoctrine()->getManager();
        $this->listarSinSolucionar($em);

        $session = new Session();

        $propiedades = array(
            'class' => 'App:Cliente',
            'choice_label' => 'nombreComercial',
            'required' => false,
            'empty_data' => '',
            'placeholder' => 'Todos',
            'data' =>'');

        if($session->get('filtroCasosCliente')){
            $propiedades['data'] = $em->getReference('App:Cliente', $session->get('filtroCasosCliente'));
        }

        $formFiltro = $this::createFormBuilder ()
            ->add('clienteRel', EntityType::class,$propiedades)
            ->add ('btnFiltrar', SubmitType::class, array (
                'label' => 'Filtrar',
                'attr' => array (
                    'class' => 'btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5'
                )
            ))
            ->getForm();


        $formFiltro->handleRequest($requestFiltro);



        if($formFiltro->isSubmitted() && $formFiltro->isValid()){
            $this->filtrar($formFiltro);
            $this->listarSinSolucionar($em);
        }

        $dql = $em->createQuery($this->strDqlLista);
        $arCaso = $dql->getResult();

        //Listado General Sin Filtro

        $user = $this->getUser();

        $form = $this::createFormBuilder()->getForm();//form para manejar los cambios de estado
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ // actualiza el estado de las llamadas
            if($request->request->has('casoAtender')) {
                $codigoCaso = $request->request->get('casoAtender');
                $arCaso = $em->getRepository('App:Caso')->find($codigoCaso);
                if(!$arCaso->getEstadoAtendido()){
                    $arCaso->setEstadoAtendido(true);
                    $arCaso->setCodigoUsuarioAtiendeFk($user->getCodigoUsuarioPk());
                    $arCaso->setFechaGestion(new \DateTime('now'));
                    $em->persist($arCaso);
                }
            }

            if($request->request->has('casoSolucionar')) {
                $codigoCaso = $request->request->get('casoSolucionar');
                $arCaso = $em->getRepository('App:Caso')->find($codigoCaso);
                if(!$arCaso->getEstadoSolucionado()){
                    $arCaso->setEstadoSolucionado(true);
                    $arCaso->setCodigoUsuarioSolucionaFk($user->getCodigoUsuarioPk());
                    $arCaso->setFechaSolucion(new \DateTime('now'));
                    $em->persist($arCaso);
                }
            }
            $em->flush();
            return $this->redirect($this->generateUrl('listadoCasosSinSolucionar'));
        }

        return $this->render('Caso/listar.html.twig', [
            'casos' => $arCaso,
            'form' => $form->createView(),
            'formFiltro' => $formFiltro->createView ()
        ]);
    }

    private function filtrar($formFiltro){
        $session = new Session();
        $filtro = $formFiltro->get('clienteRel')->getData();
        if($filtro){
            $session->set('filtroCasosCliente',$filtro->getCodigoClientePk());
        }else {
            $session->set ('filtroCasosCliente', null);
        }
    }

    private function listarSinSolucionar($em){
        $session = new Session();
//                $arCaso = $em->getRepository ('App:Caso')->findBy(array("codigoClienteFk" => $cliente),array());
        $this->strDqlLista = $em->getRepository('App:Caso')->filtroDQLSinSolucionar ($session->get('filtroCasosCliente'));
    }

	private function listarSolucionados($em){
		$session = new Session();
//                $arCaso = $em->getRepository ('App:Caso')->findBy(array("codigoClienteFk" => $cliente),array());
		$this->strDqlLista = $em->getRepository('App:Caso')->filtroDQLSolucionados ($session->get('filtroCasosCliente'));
	}

	/**
	 * @Route("/caso/lista/solucionado", name="listadoCasosSolucionados")
	 */
	public function listaSolucionados(Request $request, Request $requestFiltro) {
		$em = $this->getDoctrine()->getManager();
		$this->listarSolucionados($em);

		$session = new Session();

		$propiedades = array(
			'class' => 'App:Cliente',
			'choice_label' => 'nombreComercial',
			'required' => false,
			'empty_data' => '',
			'placeholder' => 'Todos',
			'data' =>'');

		if($session->get('filtroCasosCliente')){
			$propiedades['data'] = $em->getReference('App:Cliente', $session->get('filtroCasosCliente'));
		}

		$formFiltro = $this::createFormBuilder ()
		                   ->add('clienteRel', EntityType::class,$propiedades)
		                   ->add ('btnFiltrar', SubmitType::class, array (
			                   'label' => 'Filtrar',
			                   'attr' => array (
				                   'class' => 'btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5'
			                   )
		                   ))
		                   ->getForm();


		$formFiltro->handleRequest($requestFiltro);



		if($formFiltro->isSubmitted() && $formFiltro->isValid()){
			$this->filtrar($formFiltro);
			$this->listarSolucionados($em);
		}

		$dql = $em->createQuery($this->strDqlLista);
		$arCaso = $dql->getResult();

		//Listado General Sin Filtro

		$user = $this->getUser();

		$form = $this::createFormBuilder()->getForm();//form para manejar los cambios de estado
		$form->handleRequest($request);
		if($form->isSubmitted()){ // actualiza el estado de las llamadas
			if($request->request->has('casoAtender')) {
				$codigoCaso = $request->request->get('casoAtender');
				$arCaso = $em->getRepository('App:Caso')->find($codigoCaso);
				if(!$arCaso->getEstadoAtendido()){
					$arCaso->setEstadoAtendido(true);
					$arCaso->setCodigoUsuarioAtiendeFk($user->getCodigoUsuarioPk());
					$arCaso->setFechaGestion(new \DateTime('now'));
					$em->persist($arCaso);
				}
			}

			if($request->request->has('casoSolucionar')) {
				$codigoCaso = $request->request->get('casoSolucionar');
				$arCaso = $em->getRepository('App:Caso')->find($codigoCaso);
				if(!$arCaso->getEstadoSolucionado()){
					$arCaso->setEstadoSolucionado(true);
					$arCaso->setCodigoUsuarioSolucionaFk($user->getCodigoUsuarioPk());
					$arCaso->setFechaSolucion(new \DateTime('now'));
					$em->persist($arCaso);
				}
			}
			$em->flush();
			return $this->redirect($this->generateUrl('listadoCasosSolucionados'));
		}

		return $this->render('Caso/listar.html.twig', [
			'casos' => $arCaso,
			'form' => $form->createView(),
			'formFiltro' => $formFiltro->createView ()
		]);
	}




}
