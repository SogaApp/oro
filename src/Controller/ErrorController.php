<?php
/**
 * Created by PhpStorm.
 * User: jako
 * Date: 5/03/18
 * Time: 03:21 PM
 */

namespace App\Controller;

use App\Entity\Error;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;

class ErrorController extends Controller
{
    private $strDqlLista;

    /**
     * @Route("/error/lista", name="erroresLista")
     */
    public function lista(Request $request, Request $requestForm)
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $this->listarErrores($em);

        $propiedades = array(
            'required' => false,
            'empty_data' => '',
            'data' => $session->get("filtro-cliente"));

        $formFiltro = $this::createFormBuilder()
            ->add('cliente', TextType::class, $propiedades)
            ->add('btnFiltrar', SubmitType::class, array(
                'label' => 'Filtrar',
                'attr' => array(
                    'class' => 'btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5'
                )
            ))
            ->getForm();

        $formFiltro->handleRequest($request);
        $cliente = null;
        if ($formFiltro->isSubmitted() && $formFiltro->isValid()) {
            $this->filtrar($formFiltro);
            $this->listarErrores($em);
        }
        $query = $em->createQuery($this->strDqlLista);
        $errores = $query->getResult();

        return $this->render("Error/listar.html.twig", [
            'errores' => $errores,
            'form' => $formFiltro->createView(),
        ]);
    }

    /**
     * @Route("/error/atender/{codigoError}", name="errorAtender")
     */
    public function errorAtender($codigoError = null)
    {
        /**
         * @var $arError Error
         */
        $em = $this->getDoctrine()->getManager();
        $arError = new Error();

        if ($codigoError != null) {
            $arError = $em->getRepository('App:Error')->find($codigoError);
            $arError->setEstadoAtendido(true);
            $em->persist($arError);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('erroresLista'));
    }

    /**
     * @Route("/error/solucion/registrar/{codigoError}",requirements={"codigoError":"\d+"}, name="registrarSolucionError")
     */
    public function registrarSolucion(Request $request, $codigoError = null, \Swift_Mailer $mailer)
    {
        /**
         * @var $arError Error
         */
        $em = $this->getDoctrine()->getManager(); // instancia el entity manager
        $arError = $em->getRepository('App:Error')->find($codigoError);
        $user = $this->getUser()->getCodigoUsuarioPk();

        if (filter_var($arError->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $message = (new \Swift_Message('Hemos solucionado un error encontrado en AppSoga' . ' - ' . $arError->getId()))
                ->setFrom('sogainformacion@gmail.com')
                ->setTo($arError->getEmail())
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'Correo/Error/errorSolucionado.html.twig',
                        array('arError' => $arError)
                    ),
                    'text/html'
                );
            $mailer->send($message);
        }

        return $this->redirect($this->generateUrl('erroresLista'));
    }

    private function filtrar($formFiltro)
    {
        $session = new Session();
        $filtro = $formFiltro->get('cliente')->getData();
        if ($filtro) {
            $session->set('filtro-cliente', $filtro);
        } else {
            $session->set('filtro-cliente', null);
        }
    }

    private function listarErrores($em)
    {
        $session = new Session();
        $this->strDqlLista = $em->getRepository('App:Error')->filtroErrores($session->get('filtro-cliente'));
    }

}