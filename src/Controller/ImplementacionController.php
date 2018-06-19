<?php

namespace App\Controller;

use App\Entity\Caso;
use App\Entity\Cliente;
use App\Entity\Implementacion;
use App\Forms\Type\FormTypeCaso;
use App\Forms\Type\FormTypeImplementacion;
use App\Forms\Type\FormTypeSolicitud;
use Doctrine\DBAL\Types\IntegerType;
use FOS\RestBundle\Controller\Annotations as Rest;
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

class ImplementacionController extends Controller
{

    var $strLista = "";

    /**
     * @Route("/implementacion/lista", name="implementacion_lista")
     */
    public function listaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->formularioLista();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }
        $this->listar();
        $arImplementaciones = $em->createQuery($this->strLista)->getResult();
        return $this->render('Implementacion/lista.html.twig', [
            'arImplementaciones' => $arImplementaciones,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param int $codigoImplementacion
     * @Route("/implementacion/nuevo/{codigoImplementacion}", name="implementacion_nuevo")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function nuevoAction(Request $request, $codigoImplementacion = 0)
    {
        $em = $this->getDoctrine()->getManager();
        $arImplementacion = new Implementacion();
        if ($codigoImplementacion != 0) {
            $arImplementacion = $em->getRepository("App:Implementacion")->find($codigoImplementacion);
        }
        $form = $this->createForm(FormTypeImplementacion::class, $arImplementacion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($arImplementacion);
            $em->flush();
            return $this->redirectToRoute("implementacion_lista");
        }
        return $this->render("Implementacion/nuevo.html.twig", [
            'form' => $form->createView(),
            'arImplementacion' => $arImplementacion
        ]);

    }

    public function listar()
    {
        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        $this->strLista = $em->getRepository("App:Implementacion")->listaDql();
    }

    public function formularioLista()
    {
        return $this::createFormBuilder()->getForm();
    }

}
