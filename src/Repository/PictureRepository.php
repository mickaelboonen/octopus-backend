<?php

namespace App\Repository;

use App\Entity\{Picture, Play};
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Picture>
 *
 * @method Picture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Picture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Picture[]    findAll()
 * @method Picture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Picture::class);
    }

    public function add(Picture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Picture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Picture[] Returns an array of Picture objects
//     */
   public function findPicturesByPlay(Play $play): array
    {
        // I sepcify the alias for the entity
        $qb = $this->createQueryBuilder('p')
        ->leftJoin('p.play','pp')
        // I add the condition for precise that i want tags in the result
        ->select('p.id','p.url','p.credits','p.play')
        ->where('pp = :play')
        // I precise the parameter
        ->setParameter('play', $play);
         // I take back the QueryBuilder and the result
        return $qb->getQuery()->getResult();
    //    return $this->createQueryBuilder('p')
    //        ->andWhere('p.play = :val')
    //        ->setParameter('val', $play_id)
    //        ->getQuery()
    //        ->getResult()
    //    ;
   }

//    public function findOneBySomeField($value): ?Picture
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
