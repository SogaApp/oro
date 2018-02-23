<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class CasoCategoriaApiController extends FOSRestController {

	/**
	 * @Rest\Get("/api/lista/caso/categoria")
	 */
	public function lista( Request $request) {


		$restresult = $this->getDoctrine()->getRepository('App:CasoCategoria')->findAll();

		if ($restresult === null) {
			return new View("No hay categorias", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}


}
