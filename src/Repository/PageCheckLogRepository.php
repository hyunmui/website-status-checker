<?php

namespace App\Repository;

use App\Entity\PageCheckLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PageCheckLog>
 *
 * @method PageCheckLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageCheckLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageCheckLog[]    findAll()
 * @method PageCheckLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageCheckLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageCheckLog::class);
    }

//    /**
//     * @return PageCheckLog[] Returns an array of PageCheckLog objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PageCheckLog
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
