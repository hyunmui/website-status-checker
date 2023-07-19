<?php

namespace App\Repository;

use App\Entity\WebsiteCheckHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebsiteCheckHistory>
 *
 * @method WebsiteCheckHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebsiteCheckHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebsiteCheckHistory[]    findAll()
 * @method WebsiteCheckHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebsiteCheckHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebsiteCheckHistory::class);
    }

//    /**
//     * @return WebsiteCheckHistory[] Returns an array of WebsiteCheckHistory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WebsiteCheckHistory
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
