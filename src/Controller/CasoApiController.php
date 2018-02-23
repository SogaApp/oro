<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Caso;

class CasoApiController extends FOSRestController {

	/**
	 * @Rest\Get("/api/caso/lista/{codigoCliente}/{codigoCaso}", requirements={"codigoCaso" = "\d+","codigoCliente" = "\d+"}, defaults={"codigoCaso" = 0,"codigoCliente" = 0} )
	 */

	// listar los casos de un cliente al logueo
	public function lista( Request $request, $codigoCaso, $codigoCliente ) {

		set_time_limit(0);
        ini_set("memory_limit", -1);

		if($codigoCaso == 0){
			$restresult = $this->getDoctrine()->getRepository('App:Caso')->listarPorEmpresa($codigoCliente);
		} else {
			$restresult = $this->getDoctrine()->getRepository('App:Caso')->findBy(array('codigoClienteFk' => $codigoCliente,'codigoCasoPk' => $codigoCaso));
		}

		if ($restresult === null) {
			return new View("No hay casos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}

	/**
	 * @Rest\Post("/api/caso/nuevo")
	 */
	// crear nuevo caso de un cliente
	public function nuevo( Request $request) {
		$em = $this->getDoctrine()->getManager(); // instancia el entity manager
		$data = json_decode($request->getContent(),true);
		if($data != null){
			//captura datos del post
			$asunto = $data['asunto'];
			$correo = $data['correo'];
			$contacto = $data['contacto'];
			$telefono = $data['telefono'];
			$extension = $data['extension'];
			$descripcion = $data['descripcion'];
			$codigoCategoriaCasoFk = $data['codigo_categoria_caso_fk'];
			$codigoPrioridadFk = $data['codigo_prioridad_fk'];
			$codigoClienteFk = $data['codigo_cliente_fk'];
			$codigoAreaFk =  $data['codigo_area_fk'];
			$codigoCargoFk = $data['codigo_cargo_fk'];

			//consulta las entidades a relacionar
			$arCliente = $this->getDoctrine()->getRepository('App:Cliente')->find($codigoClienteFk);
			$arCategoria = $this->getDoctrine()->getRepository('App:CasoCategoria')->find($codigoCategoriaCasoFk);
			$arPrioridad = $this->getDoctrine()->getRepository('App:Prioridad')->find($codigoPrioridadFk);
			$arArea = $this->getDoctrine()->getRepository('App:Area')->find($codigoAreaFk);
			$arCargo= $this->getDoctrine()->getRepository('App:Cargo')->find($codigoCargoFk);

			//crea objeto tipo caso y setea las propiedades del post
			$arCaso = new Caso();
			$arCaso->setDescripcion($descripcion);
			$arCaso->setAsunto($asunto);
			$arCaso->setCorreo($correo);
			$arCaso->setContacto($contacto);
			$arCaso->setTelefono($telefono);
			$arCaso->setExtension($extension);
			$arCaso->setFechaRegistro(new \DateTime('now'));
			$arCaso->setCodigoCategoriaCasoFk($codigoCategoriaCasoFk);
			$arCaso->setCodigoPrioridadFk($codigoPrioridadFk);
			$arCaso->setEstadoAtendido(false);
			$arCaso->setEstadoSolucionado(false);
			$arCaso->setClienteRel($arCliente);
			$arCaso->setCategoriaRel($arCategoria);
			$arCaso->setPrioridadRel($arPrioridad);
			$arCaso->setAreaRel($arArea);
			$arCaso->setCargoRel($arCargo);

			$em->persist($arCaso);
			$em->flush();

			return true;
		}

	}

	/**
	 * @Rest\Post("/api/editar/casos/{caso}",  defaults={"caso" = null} )
	 */
	// editar el caso
	public function editar( Request $request, $caso ) {

		if($caso == null){ // acá logica para capturar y editar nuevo caso
			return new View("No hay ningun caso en la petición", Response::HTTP_NOT_FOUND);
		} else { // logica para editar un caso
			$restresult = null;
		}

		if ($restresult === null) {
			return new View("No hay casos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}

	/**
	 * @Rest\Get("/api/filtro/cliente/casos/{codigoCliente}/{estado}", requirements={"codigoCliente" = "\d+"}, defaults={"codigoCliente" = 0, "estado" = 0} )
	 */
	public function filtroClienteEstados( Request $request, $codigoCliente, $estado ) {

		if($codigoCliente == 0 && $estado == 0){ // acá logica para traer todos los casos de un cliente
			$restresult = null;
		} else {
			$restresult = null;
		}

		if ($restresult === null) {
			return new View("No hay casos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}
}
