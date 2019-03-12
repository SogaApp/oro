<?php

namespace App\Controller;

use App\Entity\Solicitud;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Tarea;

class ApiGeneralController extends FOSRestController
{

    /**
     * @Rest\Get("/api/general/estado/soporte/{codigoCliente}", requirements={"codigoCliente" = "\d+"}, defaults={"codigoCliente" = 0} )
     */
    public function estadoSoporte(Request $request, $codigoCliente)
    {

        set_time_limit(0);
        ini_set("memory_limit", -1);
        $jsonRestResult = false;
        $em = $this->getDoctrine()->getManager();
        if ($codigoCliente != 0) {
            $arCliente = $em->getRepository("App:Cliente")->find($codigoCliente);
            $jsonRestResult = $arCliente->getSoporteInactivo();
        }

        return $jsonRestResult;
    }

}
