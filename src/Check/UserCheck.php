<?php

namespace App\Check;

interface UserCheck
{
    public function check(int $userId): bool;
}
