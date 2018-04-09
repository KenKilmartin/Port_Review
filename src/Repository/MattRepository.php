<?php

namespace App\Repository;

use App\Entity\Matt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Matt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matt[]    findAll()
 * @method Matt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MattRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Matt::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('m')
            ->where('m.something = :value')->setParameter('value', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
