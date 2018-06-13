<?php

namespace App\Check;

use App\Check\UserCheck;
use App\Entity\User;

class UserExeededCoursesViewCheck implements UserCheck
{
    /**
     * @var int
     */
    private $coursesViewLimit;

    /**
     * @param int $coursesViewLimit
     */
    public function __construct(int $coursesViewLimit)
    {
        $this->coursesViewLimit = $coursesViewLimit;
    }

    /**
     * Match user viewed courses against application parameter.
     *
     * @param User $user
     * @return bool
     */
    public function check(User $user): bool
    {
        $viewedCourses = count($user->getViewedCourses());

        return ($viewedCourses < $this->coursesViewLimit) ? false : true;
    }
}
