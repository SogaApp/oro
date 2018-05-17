<?php

namespace App\Controller;

use App\Entity\Caso;
use App\Entity\Cliente;
use App\Entity\Solicitud;
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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SolicitudController extends Controller
{


    var $strDqlLista = "";

    /**
     * @Route("/solicitud/lista", name="solicitud_lista")
     */
    public function listaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
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
            if ($request->request->has('arSolicitudAtender')) {
                $codigoSolicitud = $request->request->get('arSolicitudAtender');
                $arSolicitud = $em->getRepository('App:Solicitud')->find($codigoSolicitud);
                if (!$arSolicitud->getEstadoAtendido()) {
                    $arSolicitud->setEstadoAtendido(true);
                    $arSolicitud->setFechaAtendido(new \DateTime('now'));
                }
                $em->persist($arSolicitud);

            }
            $em->flush();
            return $this->redirect($this->generateUrl('solicitud_lista'));

        }

        $sinAtender = 0;
        $sinCerrar = 0;

        /** @var  $arSolicitud Solicitud */
        $arSolicitudes = $em->createQuery($this->strDqlLista)->getResult();
        foreach ($arSolicitudes as $key => $arSolicitud) {
            if (!$arSolicitud->getEstadoAtendido() == null) {
                $sinAtender++;
            } else if (!$arSolicitud->getEstadoCerrado()) {
                $sinCerrar++;
            }
        }

//        $arTarea = $paginator->paginate($em->createQuery($this->strDqlLista), $request->query->get('page', 1), 20);
        return $this->render('Solicitud/listar.html.twig', [
            'arSolicitudes' => $arSolicitudes,
            'sinAtender' => $sinAtender,
            'sinCerrar' => $sinCerrar,
            'formFiltro' => $formFiltro->createView(),
            'form' => $form->createView()
        ]);
    }

    private function formularioFiltro()
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $estado = "";
        if ($session->get('estado')) {
            $arTarea = $em->getRepository('App:Solicitud')->findAll();
        };
        $formFiltro = $this::createFormBuilder()
            ->add('estado', ChoiceType::class, array('choices' => array('Todos' => '2', 'Sin atender' => '0', 'Atendido' => '1'),
                'label' => 'Atendido', 'data' => $session->get('filtroEstado', 2)))
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
        $this->strDqlLista = $em->getRepository("App:Solicitud")->listaDql($session->get('filtroEstado'));
    }


}
