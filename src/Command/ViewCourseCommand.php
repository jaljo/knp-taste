<?php

namespace App\Command;

use App\Command\Command;
use App\Entity\User;
use App\Entity\Course;

class ViewCourseCommand implements Command
{
    /**
     * @var User 
     */
    public $user;
    
    /**
     * @var Course 
     */    
    public $course;
    
    /**
     * @param User int
     * @param Course int
     */    
    public function __construct(User $user, Course $course)
    {
        $this->user = $user;
        $this->course = $course;
    }
}
