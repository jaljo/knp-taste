<?php

namespace App\Check;

use App\Check\UserCheck;
use App\Repository\UserRepository;

class UserExeededCoursesViewCheck implements UserCheck
{
    /**
     * @var UserRepository 
     */
    private $userRepository;
    
    /**
     * @var int 
     */    
    private $coursesViewLimit;
    
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, int $coursesViewLimit)
    {
        $this->userRepository = $userRepository;
        $this->coursesViewLimit = $coursesViewLimit;
    }
    
    /**
     * Match user viewed courses against application parameter.
     * 
     * @param int $userId
     * @return bool
     */
    public function check(int $userId): bool
    {
        $viewedCourses = $this->userRepository->countUserViewedCourses($userId);

        if($viewedCourses < $this->coursesViewLimit) {
            return false;
        }
        else {
            return true;
        }
    }
}
