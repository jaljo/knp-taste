<?php

namespace App\Check;

use App\Check\UserCheck;
use App\Repository\UserRepository;
use DateInterval;
use DateTime;
use App\Entity\User;

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
     * @param User $user
     * @return bool
     */
    public function check(User $user): bool
    {
        // compute interval based on given parameter
        $limitInterval = new DateInterval("P" . $this->daysBeforeLimitDrops . "D");

        // compute date at which limit expires
        $lastCourseDate = $this->userRepository->getUserLastCourseVisualizationDate($user->getId());
        $courseLimitExpires = $lastCourseDate->add($limitInterval);

        // match this date with current timestamp
        return ($courseLimitExpires < new DateTime()) ? true : false;
    }
}
