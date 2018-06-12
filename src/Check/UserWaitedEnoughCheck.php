<?php

namespace App\Check;

use App\Check\UserCheck;
use App\Repository\UserRepository;
use DateInterval;
use DateTime;

class UserWaitedEnoughCheck implements UserCheck
{
    /**
     * @var UserRepository 
     */
    private $userRepository;
    
    /**
     * @var int 
     */    
    private $daysBeforeLimitDrops;
    
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, int $daysBeforeLimitDrops)
    {
        $this->userRepository = $userRepository;
        $this->daysBeforeLimitDrops = $daysBeforeLimitDrops;
    }
    
    /**
     * Match user last viewed course date against application parameter.
     * 
     * @param int $userId
     * @return bool
     */
    public function check(int $userId): bool
    {
        // compute interval based on given parameter
        $limitInterval = new DateInterval("P" . $this->daysBeforeLimitDrops . "D");
        
        // compute date at which limit expires
        $lastCourseDate = $this->userRepository->getUserLastCourseVisualizationDate($userId);    
        $courseLimitExpires = $lastCourseDate->add($limitInterval);

        // match this date with current timestamp
        if($courseLimitExpires < new DateTime()) {
            return true;
        }
        else {
            return false;
        }
    }
}
