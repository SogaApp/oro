<?php
/**
 * Created by PhpStorm.
 * User: jako
 * Date: 5/03/18
 * Time: 09:04 AM
 */

namespace App\Controller;


use App\Entity\Error;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class ApiErrorController extends Controller
{

    /**
     * @Rest\Post("/api/error/nuevo")
     */
    public function nuevo(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);

        $cliente = $em->getRepository("App:Cliente")->find($data['codigo_cliente']);
        $error = new Error();
        if($cliente) {
            $error->setClienteRel($cliente);
        }
        $error->setCliente($data['nombre_cliente'])
            ->setMensaje($data['mensaje'])
            ->setCodigo($data['codigo'])
            ->setRuta($data['ruta'])
            ->setArchivo($data['archivo'])
            ->setTraza($data['traza'])
            ->setFecha(new \DateTime($data['fecha']))
            ->setUrl($data['url'])
            ->setUsuario($data['usuario'])
            ->setNombreUsuario($data['nombre_usuario'])
            ->setEmail($data['email']);
        $em->persist($error);
        $em->flush();
        return $error->getId() != null;
    }

    /**
     * @Rest\Get("/api/error/lista/{pagina}/{cliente}/{fecha}", requirements={"pagina"="\d+"}, defaults={"pagina"=1, "cliente"=null, "fecha"=null})
     */
    public function lista(Request $request, $pagina=null, $cliente=null, $fecha=null)
    {
        $limite = 100;
        $em = $this->getDoctrine()->getManager();
        $arrResultados = $em->getRepository("App:Error")->listaApi($pagina, $cliente, $fecha, $limite);
        if(!$arrResultados) {
            return new View("No hay errores", Response::HTTP_NOT_FOUND);
        }
        return $arrResultados;
    }

    /**
     * @Rest\Get("/api/error/lista/mercurio/{codigoCliente}", defaults={"codigoCliente"=null})
     */
    public function listaMercurio(Request $request, $codigoCliente=null)
    {
        $em = $this->getDoctrine()->getManager();
        $arrResultados = $em->getRepository("App:Error")->apiListaMercurio($codigoCliente);
        if(!$arrResultados) {
            return new View("No hay errores", Response::HTTP_NOT_FOUND);
        }
        return $arrResultados;
    }

    /**
     * @Rest\Get("/api/error/get/{codigo}", requirements={"codigo"="\d+"})
     * @param Request $request
     * @param $codigo
     */
    public function listaUno(Request $request, $codigo)
    {
        $em = $this->getDoctrine()->getManager();
        $arError = $em->getRepository("App:Error")->listaUnoApi($codigo);
        if(!$arError) {
            return new View("No hay errores", Response::HTTP_NOT_FOUND);
        }
        return $arError;
    }
}
