<?php

namespace App\Repository;

use App\Entity\CheckScreenshot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CheckScreenshot>
 *
 * @method CheckScreenshot|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckScreenshot|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckScreenshot[]    findAll()
 * @method CheckScreenshot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckScreenshotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckScreenshot::class);
    }

//    /**
//     * @return CheckScreenshot[] Returns an array of CheckScreenshot objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CheckScreenshot
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
