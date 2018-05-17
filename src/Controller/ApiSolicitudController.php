<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Tarea;

class ApiSolicitudController extends FOSRestController
{
    /**
     * @Rest\Get("/api/solicitud/lista/{intCodigoCliente}", requirements={"intCodigoCliente" = "\d+"}, defaults={"intCodigoCliente" = 0} )
     */

    /*
    * $intCodigoCLiente = 0 default Es el códigoClientePk seteado en base de datos(requerido).
    * listar los casos de un cliente al logueo
    */
    public function listaEmpresa(Request $request, $intCodigoCliente)
    {

        set_time_limit(0);
        ini_set("memory_limit", -1);

        if ($intCodigoCliente != 0) {
            $jsonRestResult = $this->getDoctrine()->getRepository('App:Solicitud')->listarPorEmpresa($intCodigoCliente);
        }

        if ($jsonRestResult === null) {
            return new View("No hay solicitudes", Response::HTTP_NOT_FOUND);
        }
        return $jsonRestResult;
    }
}
