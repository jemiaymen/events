<?php

namespace App\Repository;

use App\Entity\AttendeeTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AttendeeTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttendeeTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttendeeTypes[]    findAll()
 * @method AttendeeTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttendeeTypesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AttendeeTypes::class);
    }

    // /**
    //  * @return AttendeeTypes[] Returns an array of AttendeeTypes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AttendeeTypes
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
