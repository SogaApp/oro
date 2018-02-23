<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class CargoApiController extends FOSRestController {

	/**
	 * @Rest\Get("/api/lista/cargo")
	 */
	public function lista( Request $request) {


		$restresult = $this->getDoctrine()->getRepository('App:Cargo')->findAll();

		if ($restresult === null) {
			return new View("No hay cargos", Response::HTTP_NOT_FOUND);
		}
		return $restresult;
	}


}
