<?php

/**
 * Created by Juan David Marulanda V.
 * User: @ju4nr3v0l
 * appSoga developers Team.
 */

namespace App\Controller;

use App\Forms\Type\FormTypeTarea;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Tarea;
use Symfony\Component\HttpFoundation\Request;

class Tarea2Controller extends Controller
{

	/**
	 * @Route("/tarea2/lista",name="listaTarea2")
	 */
	public function nuevo(Request $request){



		return $this->render('App:Tarea:lista2.html.twig',
			array(
				'issues' => $issues,
				'issuesEnvents' => $issuesEvents,
				'infoRepo' => $infoRepo,
			)
		);
	}
}