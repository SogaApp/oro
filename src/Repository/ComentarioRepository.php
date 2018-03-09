<?php

namespace App\Repository;

use App\Entity\Comentario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Comentario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comentario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comentario[]    findAll()
 * @method Comentario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComentarioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comentario::class);
    }

    public function apiListaCaso( $codigoCaso ) {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->from( "App:Comentario", "c" )
            ->select( "c.codigoComentarioPk" )
            ->addSelect( "c.fechaCreacion" )
            ->addSelect( "c.comentario" )
            ->addSelect( "c.codigoUsuarioFk" )
            ->where( "c.codigoCasoFk = {$codigoCaso}" );
        return $qb->getQuery()->getResult();
    }
}
