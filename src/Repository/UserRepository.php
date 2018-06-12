<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use DateTimeInterface;

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
        $userWithCourses = $this->createQueryBuilder("u")
                ->join("u.viewedCourses", "vc")
                ->where("u.id = :user_id")
                ->setParameter("user_id", $userId)
                ->getQuery()
                ->getSingleResult();
        
        return count($userWithCourses->getViewedCourses());
    }
    
    /**
     * @param int $userId
     * @return DateTimeInterface
     */
    public function getUserLastCourseVisualizationDate(int $userId): DateTimeInterface
    {
        $query = "SELECT uc.viewDate "
                . "FROM user_course uc "
                . "INNER JOIN user u "
                . "ON uc.user_id = u.id "
                . "WHERE u.id = :user_id "
                . "ORDER BY uc.view_date DESC "
                . "LIMIT 1;";
                
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bindValue("user_id", $userId);
        
        $lastViewDate = $stmt->execute();
        
        var_dump($lastViewDate);
        exit;
    }
}
