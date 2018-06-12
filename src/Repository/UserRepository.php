<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();
    }
    
    /**
     * @param int $userId
     * @return int
     */
    public function countUserViewedCourses(int $userId): int
    {
        $nUserCourses = $this->createQueryBuilder("COUNT(u)")
                ->join("u.viewedCourses")
                ->where("u.id = :user_id")
                ->setParameter("user_id", $userId)
                ->getQuery()
                ->getSingleScalarResult();
        
        return $nUserCourses;
    }
}
