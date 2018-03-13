<?php

namespace App\Controller;

use App\Entity\Caso;
use App\Entity\Comentario;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class ApiComentarioController extends FOSRestController
{
    /**
     * @Rest\Get("/api/comentario/lista/caso/{codigoCaso}", requirements={"codigoCaso" = "\d+"}, defaults={"codigoCaso" = 0})
     */
    public function listaCaso(Request $request, $codigoCaso)
    {

        set_time_limit(0);
        ini_set("memory_limit", -1);

        if ($codigoCaso != 0) {
            $jsonRestResult = $this->getDoctrine()->getRepository('App:Comentario')->apiListaCaso($codigoCaso);
        }

        if ($jsonRestResult === null) {
            return new View("No hay comentarios", Response::HTTP_NOT_FOUND);
        }
        return $jsonRestResult;
    }

    /**
     * @Rest\Post("/api/comentario/nuevo/caso/{codigoCaso}/{usuario}")
     */
    public function nuevoCaso(Request $request, $codigoCaso = '', $usuario = '')
    {
        $em = $this->getDoctrine()->getManager();
        $arCaso = $em->getRepository(Caso::class)->find($codigoCaso);
        $arrComentario = json_decode($request->getContent(), true);

        set_time_limit(0);
        ini_set("memory_limit", -1);
        $arComentario = new Comentario();

        if ($codigoCaso <> 0 and $usuario <> 0) {
            $arComentario->setCasoRel($arCaso);
            $arComentario->setFechaCreacion(new \DateTime('now'));
            $arComentario->setCodigoUsuarioFk($usuario);
            $arComentario->setComentario($arrComentario['comentario']);
            $arComentario->setCliente(1);
            $em->persist($arComentario);
            $em->flush();
            return true;
        } else {
            return false;
        }
    }
}
