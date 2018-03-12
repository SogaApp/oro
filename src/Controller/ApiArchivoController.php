<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Tarea;

class ApiArchivoController extends FOSRestController
{
    /**
     * @Rest\Post("/api/archivo/nuevo/{codigoDocumento}/{numero}", requirements={"codigoDocumento" = "\d+", "numero" = "\d+"}, defaults={"codigoDocumento" = 0, "numero" = 0})
     */
    public function nuevo(Request $request, $codigoDocumento, $numero)
    {
        $file = $request->getContent();
        set_time_limit(0);
        ini_set("memory_limit", -1);
        if ($codigoDocumento != 0 && $numero != 0) {
            $file_array = explode("\n\r", $file, 2);
            $header_array = explode("\n", $file_array[0]);
            foreach($header_array as $header_value) {
                $header_pieces = explode(':', $header_value);
                if(count($header_pieces) == 2) {
                    $headers[$header_pieces[0]] = trim($header_pieces[1]);
                }
            }
            $nombreArchivo = explode(";", $header_array[1]);
            //$archivo = explode("\r\n", $data['archivo']);
            move_uploaded_file($file_array[1], "/var/www/archivosoro/prueba.pdf");


            //$form['attachment']->getData()->move($strDestino, $strArchivo);
            //$jsonRestResult = $this->getDoctrine()->getRepository('App:Tarea')->apiListaCaso($codigoCaso);
            $prueba = 1;
        }

        /*if ($jsonRestResult === null) {
            return new View("No hay tareas", Response::HTTP_NOT_FOUND);
        }*/
        return true;
    }
}
