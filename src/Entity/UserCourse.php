<?php

namespace App\Entity;

use DateTimeInterface;
use App\Entity\Course;
use App\Entity\User;

/**
 * This entity has no repository because it should never be accessed directly. Use user or course repository instead.
 */
class UserCourse
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DateTimeInterface
     */
    private $viewDate;

    /**
     * @var Course
     */    
    private $course;
    
    /**
     * @var User
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
