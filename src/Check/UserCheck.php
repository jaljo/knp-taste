<?php

namespace App\Check;

use App\Entity\User;

interface UserCheck
{
    public function check(User $user): bool;
}
