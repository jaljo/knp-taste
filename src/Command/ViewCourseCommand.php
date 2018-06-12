<?php

namespace App\Command;

use App\Command\Command;

class ViewCourseCommand implements Command
{
    /**
     * @var int 
     */
    public $userId;
    
    /**
     * @param $userId int
     */    
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
}