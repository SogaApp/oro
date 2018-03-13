<?php

namespace App\Repository;


class ComentarioRepository extends \Doctrine\ORM\EntityRepository
{
    public function apiListaCaso( $codigoCaso ) {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->from( "App:Comentario", "c" )
            ->select( "c.codigoComentarioPk" )
            ->where( "c.codigoCasoFk = {$codigoCaso}" );
        return $qb->getQuery()->getResult();
    }
}
