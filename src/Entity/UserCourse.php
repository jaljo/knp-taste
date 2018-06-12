<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use App\Entity\Course;
use App\Entity\User;

/**
 * This entity has no repository because it should never be accessed directly. Use user or course repository instead.
 * 
 * @ORM\Entity()
 */
class UserCourse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $viewDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Course", inversedBy="usersVisualizations")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     */    
    private $course;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="viewedCourses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */    
    private $user;
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * @return DateTimeInterface
     */
    public function getViewDate(): DateTimeInterface
    {
        return $this->viewDate;
    }
    
    /**
     * @return Course
     */    
    public function getCourse(): Course
    {
        return $this->course;
    }
    
    /**
     * @return User
     */    
    public function getUser(): User
    {
        return $this->user;
    }
}
