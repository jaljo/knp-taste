<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use DateTimeInterface;
use DateTime;

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
     * @todo I used DBAL for convenience, but there should be a way to do this using DQL.
     * 
     * @param int $userId
     * @return DateTimeInterface
     */
    public function getUserLastCourseVisualizationDate(int $userId): DateTimeInterface
    {
        $query = "SELECT uc.view_date "
                . "FROM user_course uc "
                . "INNER JOIN user u "
                . "ON uc.user_id = u.id "
                . "WHERE u.id = :user_id "
                . "ORDER BY uc.view_date DESC "
                . "LIMIT 1;";
                
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bindValue("user_id", $userId);
        $stmt->execute();
        
        // convert string to datetime
        $lastViewDateString = $stmt->fetch();
        $lastViewDate = new DateTime($lastViewDateString["view_date"]);
        
        return $lastViewDate;
    }
}
