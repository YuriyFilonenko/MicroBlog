<?php

namespace App\Repository;

use App\Entity\MicroPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method null|MicroPost find($id, $lockMode = null, $lockVersion = null)
 * @method null|MicroPost findOneBy(array $criteria, array $orderBy = null)
 * @method MicroPost[]    findAll()
 * @method MicroPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MicroPostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MicroPost::class);
    }
}
