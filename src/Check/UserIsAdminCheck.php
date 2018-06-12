<?php

namespace App\Check;

use App\Check\UserCheck;
use App\Repository\UserRepository;

class UserIsAdminCheck implements UserCheck
{
    /**
     * @var UserRepository 
     */
    private $userRepository;
    
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * Fetch user in database then check for user role.
     * 
     * @param int $userId
     * @return bool
     */
    public function check(int $userId): bool
    {
        $user = $this->userRepository->find($userId);
        
        if(true === in_array("ROLE_ADMIN", $user->getRoles())) {
            return true;
        }
        else {
            return false;
        }
    }
}
