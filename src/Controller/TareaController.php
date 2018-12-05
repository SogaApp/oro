<?php

/**
 * Created by Juan David Marulanda V.
 * User: @ju4nr3v0l
 * appSoga developers Team.
 */

namespace App\Controller;


use App\Entity\Caso;
use App\Entity\Comentario;
use App\Forms\Type\FormTypeTarea;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Tarea;
use App\Entity\Usuario;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TareaController extends Controller
{
    var $strDqlLista = "";


    /**
     * @Route("/tarea/nuevo/{codigoTarea}", requirements={"codigoTarea":"\d+"}, name="registrarTarea")
     */
    public function nuevo(Request $request, $codigoTarea = null)
    {

        /**
         * @var Usuario $arUser
         **/
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $user = $this->getUser(); // trae el usuario actual
        $arTarea = new Tarea(); //instance class
        if ($codigoTarea) {
            $arTarea = $em->getRepository('App:Tarea')->find($codigoTarea);
        } else {
            $arTarea->setEstadoTerminado(false);

        }

        $form = $this->createForm(FormTypeTarea::class, $arTarea); //create form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$codigoTarea) {
                $id = $user->getCodigoUsuarioPk();
                $arTarea->setFechaRegistro(new \DateTime('now'));
                $arTarea->setCodigoUsuarioRegistraFk($id);
            }
            $arUser = $arTarea->getCodigoUsuarioAsignaFk();
            if ($arUser != null) {
                $arTarea->setFechaGestion(new \DateTime('now'));
                $arTarea->setCodigoUsuarioAsignaFk($arUser->getCodigoUsuarioPk());
            }
            $em->persist($arTarea);
            $em->flush();
            if ($codigoTarea) {
                echo "<script languaje='javascript' type='text/javascript'>window.close();window.opener.location.reload();</script>";
            }else{
                return $this->redirect($this->generateUrl('listaTareaGeneral'));
            }
        }

        return $this->render('Tarea/crear.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/tarea/ver/{codigoTarea}", requirements={"codigoTarea":"\d+"}, name="verTarea")
     */
    /*
     * Ver una tarea y sus comentarios
     */
    public function verTarea(Request $request, $codigoTarea = null)
    {

        /**
         * @var Usuario $arUser
         **/
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $arTarea = $em->getRepository('App:Tarea')->find($codigoTarea);
        $form = $this->formularioDetalles($arTarea);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('btnGuardar')->isClicked()){
                $arTarea->setComentario($form->get('comentario')->getData());
                $em->persist($arTarea);
            }
            if($form->get('BtnEjecucion')->isClicked()){
                $arTarea->setEstadoEjecucion(1);
                $arTarea->setFechaEjecucion(new \DateTime('now'));
                $em->persist($arTarea);
            }
            if($form->get('BtnResuelto')->isClicked()) {
                $arTarea->setEstadoTerminado(1);
                $arTarea->setFechaSolucion(new \DateTime('now'));
                $em->persist($arTarea);
                if ($arTarea->getCodigoCasoFk()) {
                    $arCaso = $em->getRepository(Caso::class)->find($arTarea->getCodigoCasoFk());
                    $arCaso->setEstadoTareaTerminada(1);
                    $em->persist($arCaso);
                }

            }
            if($form->get('BtnVerificado')->isClicked()) {
                $arTarea->setEstadoVerificado(1);
                $arTarea->setFechaVerificado(new \DateTime('now'));
                $em->persist($arTarea);
                if ($arTarea->getCodigoCasoFk()) {
                    $arCaso = $em->getRepository(Caso::class)->find($arTarea->getCodigoCasoFk());
                    $arCaso->setEstadoTareaRevisada(1);
                    $em->persist($arCaso);
                }
            }
            if($form->get('BtnAbrir')->isClicked()) {
                $arTarea->setEstadoEjecucion(0);
                $arTarea->setEstadoTerminado(0);
                $arTarea->setEstadoVerificado(0);
                $arTarea->setFechaEjecucion(null);
                $arTarea->setFechaSolucion(null);
                $arTarea->setFechaVerificado(null);
                $em->persist($arTarea);

                if ($arTarea->getCodigoCasoFk()) {
                    $arCaso = $em->getRepository(Caso::class)->find($arTarea->getCodigoCasoFk());
                    $arCaso->setEstadoTareaTerminada(0);
                    $arCaso->setEstadoTareaRevisada(0);
                    $em->persist($arCaso);
                }

                }
                $em->flush();
            return $this->redirect($this->generateUrl('verTarea', array('codigoTarea' => $codigoTarea)));

        }
            return $this->render('Tarea/verTarea.html.twig',

            array(
                'tarea' => $arTarea,
                'form' => $form->createView()
            )
        );
    }

    /**
     * @Route("/tarea/nuevo/caso/{codigoCaso}", requirements={"codigoCaso":"\d+"}, name="registrarTareaDesdeCaso")
     *
     */
    /*
     * Registra una tarea desde caso
     */
    public function nuevoTareaDesdeCaso(Request $request, $codigoCaso = null)
    {

        /**
         * @var Usuario $arUser
         **/

        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $user = $this->getUser(); // trae el usuario actual
        $arTarea = new Tarea(); //instance class
        if ($codigoCaso != null) {
            $arCaso = $em->getRepository('App:Caso')->find($codigoCaso);
        }
        $form = $this->createForm(FormTypeTarea::class, $arTarea); //create form
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $arTarea->setCasoRel($arCaso);
            $arTarea->setCodigoUsuarioRegistraFk($user->getCodigoUsuarioPk());
            $arTarea->setFechaRegistro(new \DateTime('now'));

//			$prioridadRel = $form->get('prioridadRel')->getData();
//			$tareaTipoRel = $form->get('tareaTipoRel')->getData();
//			$arPrioridadRel = $em->getRepository('App:Prioridad')->find($prioridadRel);
//			$arTareaTipoRel = $em->getRepository('App:TareaTipo')->find($tareaTipoRel);
            $usuarioAsignado = $form->get('codigoUsuarioAsignaFk')->getData();
            if ($usuarioAsignado != null) {
                $arTarea->setCodigoUsuarioAsignaFk($usuarioAsignado->getCodigoUsuarioPk());
//				$arTarea->setPrioridadRel($arPrioridadRel);
//				$arTarea->setTareaTipoRel($arTareaTipoRel);
            }
            $arTarea->setFechaGestion(new \DateTime('now'));

            if ($arCaso->getEstadoAtendido() == true) {
                $arCaso->setEstadoTarea(1);
                $em->persist($arCaso);

                $em->persist($arTarea);
                $em->flush();
                echo "<script>window.opener.location.reload();window.close()</script>";
            } else {
                echo "<script>alert('El caso debe estar atendido para asignar una tarea');window.close()</script>";
            }


        }

        return $this->render('Tarea/crearDesdeCaso.html.twig',
            array(
                'form' => $form->createView(),
                'caso' => $arCaso
            )
        );
    }


    /**
     * @Route("/tarea/lista", name="listaTareaGeneral")
     */
    public function listaGeneral(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');
//        $arTarea = new \App\Entity\Tarea();
        //   $session = $this->get('session');
//        $session->set('filtroEstado', 2);
        $formFiltro = $this->formularioFiltro();
        $formFiltro->handleRequest($request);
        $this->listar();
        if ($formFiltro->isSubmitted() && $formFiltro->isValid()) {
            if ($formFiltro->get('BtnFiltrar')->isClicked()) {
                $this->filtrar($formFiltro);
                $this->listar();
            }
        }
        $form = $this::createFormBuilder()->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->request->has('TareaSolucionar')) {
                $codigoTarea = $request->request->get('TareaSolucionar');
                $arTarea = $em->getRepository('App:Tarea')->find($codigoTarea);
                if (!$arTarea->getEstadoTerminado()) {
                    $arTarea->setEstadoTerminado(true);
                    $arTarea->setFechaSolucion(new \DateTime('now'));
                }
                $em->persist($arTarea);

                if ($arTarea->getCodigoCasoFk()) {
                    $arCaso = $em->getRepository(Caso::class)->find($arTarea->getCodigoCasoFk());
                    $arCaso->setEstadoTareaTerminada(1);
                    $em->persist($arCaso);
                }

            }
            if ($request->request->has('TareaVerificar')) {
                $codigoTarea = $request->request->get('TareaVerificar');
                $arTarea = $em->getRepository('App:Tarea')->find($codigoTarea);
                if (!$arTarea->getEstadoVerificado()) {
                    $arTarea->setFechaVerificado(new \DateTime('now'));
                    $arTarea->setEstadoVerificado(true);
                }
                $em->persist($arTarea);
                if ($arTarea->getCodigoCasoFk()) {
                    $arCaso = $em->getRepository(Caso::class)->find($arTarea->getCodigoCasoFk());
                    $arCaso->setEstadoTareaRevisada(1);
                    $em->persist($arCaso);
                }
            }
            $em->flush();
            return $this->redirect($this->generateUrl('listaTareaGeneral'));

        }

        $sinTerminar = 0;
        $sinAsignar = 0;
        $sinVerificar = 0;

        $arTarea = $em->createQuery($this->strDqlLista)->getResult();
        foreach ($arTarea as $key => $value) {
            if ($value->getCodigoUsuarioAsignaFk() == null) {
                $sinAsignar++;
            } else if (!$value->getEstadoTerminado()) {
                $sinTerminar++;
            } else if ($value->getEstadoTerminado() && !$value->getEstadoVerificado()) {
                $sinVerificar++;
            }
        }

        $arrTareas = $paginator->paginate($em->createQuery($this->strDqlLista), $request->query->get('page', 1), 20);
        return $this->render('Tarea/listar.html.twig', [
            'tareas' => $arrTareas,
            'sinTerminar' => $sinTerminar,
            'sinAsignar' => $sinAsignar,
            'sinVerificar' => $sinVerificar,
            'formFiltro' => $formFiltro->createView(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/tarea/comentarios/{codigoTareaPk}",requirements={"codigoTareaPk":"\d+"}, name="verComentariosTarea")
     */

    public function verComentariosTarea($codigoTareaPk)
    {
        $em = $this->getDoctrine()->getManager();
        $comentarios = $em->getRepository('App:Comentario')->findBy(array('codigoTareaFk' => $codigoTareaPk));
        return $this->render('Tarea/verComentarios.html.twig', array(
            'comentarios' => $comentarios
        ));
    }

    /**
     * @Route("/tarea/lista/usuario", name="listaTareaUsuario")
     */
    public function listaUsuario(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');
        $user = $this->getUser();
        $arTarea = $em->getRepository('App:Tarea')->findBy(array('codigoUsuarioAsignaFk' => $user->getCodigoUsuarioPk(), 'estadoTerminado' => false), array('estadoTerminado' => 'ASC', 'estadoVerificado' => 'ASC', 'fechaGestion' => 'DESC'));// consulta llamadas por usuario logueado
        $form = $this::createFormBuilder()->getForm(); // form para manejar actualizacion de estado de llamadas
        $form->handleRequest($request);
        $sinTerminar = 0;
        $sinVerificar = 0;
        foreach ($arTarea as $key => $value) {
            if (!$value->getEstadoTerminado()) {
                $sinTerminar++;
            } else if (!$value->getEstadoVerificado()) {
                $sinVerificar++;
            }
        }
        if ($form->isSubmitted() && $form->isValid()) { // actualiza el estado de las llamadas
            if ($request->request->has('TareaEjecucion')) {
                $codigoTarea = $request->request->get('TareaEjecucion');
                $arTarea = $em->getRepository('App:Tarea')->find($codigoTarea);
                if ($arTarea->getEstadoEjecucion() == 0) {
                    $arTarea->setEstadoEjecucion(true);
                    $arTarea->setFechaEjecucion(new \DateTime('now'));
                    $em->persist($arTarea);

                    $arUsuario = $em->getRepository('App:Usuario')->find($this->getUser()->getCodigoUsuarioPk());
                    $arUsuario->setTareaRel($arTarea);
                    $em->persist($arUsuario);
                } else {
                    $arTarea->setEstadoEjecucion(false);
                    $em->persist($arTarea);

                    $arUsuario = $em->getRepository('App:Usuario')->find($this->getUser()->getCodigoUsuarioPk());
                    $arUsuario->setTareaRel(null);
                    $em->persist($arUsuario);
                }
            }
            if ($request->request->has('TareaSolucionar')) {
                $codigoTarea = $request->request->get('TareaSolucionar');
                $arTarea = $em->getRepository('App:Tarea')->find($codigoTarea);
                if (!$arTarea->getEstadoTerminado()) {
                    $arTarea->setEstadoTerminado(true);
                    $arTarea->setFechaSolucion(new \DateTime('now'));
                    $em->persist($arTarea);
                    $arUsuario = $em->getRepository('App:Usuario')->find($this->getUser()->getCodigoUsuarioPk());
                    if ($arUsuario->getCodigoTareaFk() == $codigoTarea) {
                        $arUsuario->setTareaRel(null);
                        $em->persist($arUsuario);
                    }
                    $em->persist($arTarea);
                    if ($arTarea->getCodigoCasoFk()) {
                        $arCaso = $em->getRepository(Caso::class)->find($arTarea->getCodigoCasoFk());
                        $arCaso->setEstadoTareaTerminada(1);
                        $em->persist($arCaso);
                    }
                }
            }
            if ($request->request->has('TareaVerificar')) {
                $codigoTarea = $request->request->get('TareaVerificar');
                $arTarea = $em->getRepository('App:Tarea')->find($codigoTarea);
                if (!$arTarea->getEstadoVerificado()) {
                    $arTarea->setFechaVerificado(new \DateTime('now'));
                    $arTarea->setEstadoVerificado(true);
                }
                $em->persist($arTarea);
                if ($arTarea->getCodigoCasoFk()) {
                    $arCaso = $em->getRepository(Caso::class)->find($arTarea->getCodigoCasoFk());
                    $arCaso->setEstadoTareaRevisada(1);
                    $em->persist($arCaso);
                }

            }

            if ($request->request->has('TareaIncompresible')) {
                $codigoTarea = $request->request->get('TareaIncompresible');
                $arTarea = $em->getRepository('App:Tarea')->find($codigoTarea);
                    $arTarea->setEstadoIncomprensible(true);
                $em->persist($arTarea);
            }

            $em->flush();
            return $this->redirect($this->generateUrl('listaTareaUsuario'));
        }

        $arrTareas = $paginator->paginate($arTarea, $request->query->get('page', 1), 20);


        return $this->render('Tarea/listarUsuario.html.twig', [
            'tareas' => $arrTareas,
            'sinTerminar' => $sinTerminar,
            'sinVerificar' => $sinVerificar,
            'form' => $form->createView(),
        ]);


    }


    /**
     * @Route("/tarea/comentario/registrar/{codigoTarea}/{codigoSolicitud}",requirements={"codigoTarea":"\d+","codigoSolicitud":"\d+"}, name="registrarComentario")
     */
    public function registrarComentario(Request $request, $codigoTarea = 0, $codigoSolicitud = 0)
    {

        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $arComentario = new Comentario();
        $form = $this->createFormBuilder()
            ->add('comentario', TextareaType::class)
            ->add('btnGuardar', SubmitType::class, ['label'=>'Guardar'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($codigoTarea != 0) {
                $arTarea = $em->getRepository('App:Tarea')->find($codigoTarea);
                $user = $em->getRepository('App:Usuario')->find($arTarea->getCodigoUsuarioAsignaFk());
                $idUser = $user->getCodigoUsuarioPk();
            }
            if ($codigoSolicitud != 0) {
                $arSolicitud = $em->getRepository("App:Solicitud")->find($codigoSolicitud);
                $idUser = $this->getUser()->getCodigoUsuarioPk();
            }
            $arComentario->setFechaRegistro(new \DateTime('now'));
            $arComentario->setComentario($form->get('comentario')->getData());
            $arComentario->setCodigoUsuarioFk($idUser);
            if ($codigoTarea != 0) {
                $arComentario->setTareaRel($arTarea);
            }
            if ($codigoSolicitud != 0) {
                $arComentario->setSolicitudRel($arSolicitud);
            }
            $em->persist($arComentario);


            $em->flush();
            echo "<script>window.opener.location.reload();window.close()</script>";
        }

        return $this->render('Tarea/comentario.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tarea/lista/historico", name="listaTareaHistorico")
     */
    public function listaHistorico(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $arTarea = $em->getRepository('App:Tarea')->findBy(array('estadoVerificado' => true), array('fechaRegistro' => 'DESC'));
        $arrTareas = $paginator->paginate($arTarea, $request->query->get('page', 1),20);


        // en index pagina con datos generales de la app
        return $this->render('Tarea/listarHistorico.html.twig', [
            'tareas' => $arrTareas,
        ]);
    }


    private function formularioFiltro()
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $estado = "";
        if ($session->get('estado')) {
            $arTarea = $em->getRepository('App:Tarea')->findAll();
        };
        $formFiltro = $this::createFormBuilder()
            ->add('estado', ChoiceType::class, array('choices' => array('Todos' => '2', 'Sin resolver' => '0', 'Resueltos' => '1'),
                'label' => 'Filtro', 'data' => $session->get('filtroEstado', 2)))
            ->add('BtnFiltrar', SubmitType::class, array('label' => 'Filtrar'))
            ->getForm();

        return $formFiltro;

    }

    private function filtrar($formFiltro)
    {
        $session = new Session();
        $session->set('filtroEstado', $formFiltro->get('estado')->getData());

    }


    private function listar()
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $this->strDqlLista = $em->getRepository('App:Tarea')->listaDql($session->get('filtroEstado'));
    }

    /**
     * @Route("/tarea/lista/{intCodigoCasoFk}", requirements={"intCodigoCasoFk":"\d+"}, name="listaTareaCaso")
     */
    public function listaTareaCaso(Request $request, $intCodigoCasoFk = 0)
    {

        $em = $this->getDoctrine()->getManager();
        if ($intCodigoCasoFk != 0) {
            $arTareas = $em->getRepository('App:Tarea')->listaPorCaso($intCodigoCasoFk);
        }
        $sinTerminar = 0;
        $sinVerificar = 0;

        return $this->render('Tarea/listarPorCaso.html.twig', array(
            'tareas' => $arTareas,
            'codigoCaso' => $intCodigoCasoFk

        ));

    }

        private function formularioDetalles($arTarea){
        $arrBotonEjecucion = array('label' => 'Ejecucion');
        $arrBotonResuelto = array('label' => 'Resuelto');
        $arrBotonVerificado = array('label' => 'Verificado','attr' => array('style'=> 'display:none;'));
        $arrBotonAbrir = array('label' => 'Abrir','attr' => array('style'=> 'display:none;'));
        if($arTarea->getEstadoEjecucion() == 1){
            $arrBotonEjecucion['attr']['style'] = 'display:none;';
        }
            if($arTarea->getEstadoTerminado() == 1){
                $arrBotonResuelto['attr']['style'] = 'display:none;';
                $arrBotonVerificado['attr']['style'] = '';
                $arrBotonAbrir['attr']['style'] = '';

            }
            if($arTarea->getEstadoVerificado() == 1){
                $arrBotonVerificado['attr']['style'] = 'display:none;';
                $arrBotonAbrir['attr']['style'] = 'display:block;';

            }
            if($arTarea->getEstadoIncomprensible() == 1){
                $arrBotonEjecucion['attr']['style'] = 'display:none;';
                $arrBotonResuelto['attr']['style'] = 'display:none;';
                $arrBotonVerificado['attr']['style'] = 'display:none;';
                $arrBotonAbrir['attr']['style'] = 'display:block;';

            }



                $form = $this->createFormBuilder()
                ->add('BtnEjecucion',SubmitType::class,$arrBotonEjecucion)
                ->add('BtnResuelto',SubmitType::class,$arrBotonResuelto)
                ->add('BtnVerificado',SubmitType::class,$arrBotonVerificado)
                    ->add('BtnAbrir',SubmitType::class,$arrBotonAbrir)
                ->add('comentario',TextareaType::class,array('label'=> 'Comentarios'))
                ->add('btnGuardar',SubmitType::class,array('label' => 'Guardar'))
                ->getForm();
            return $form;
        }

}
