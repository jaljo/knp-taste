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
    
    public function check(int $userId): bool
    {
        
    }
}
