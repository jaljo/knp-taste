<?php

namespace App\Command;

use App\Command\Command;

class ViewCourseCommand implements Command
{
    /**
     * @var int 
     */
    private $userId;
    
    /**
     * @var int 
     */    
    private $courseId;
    
    /**
     * @param $userId int
     * @param $courseId int
     */    
    public function __construct(int $userId, int $courseId)
    {
        $this->userId = $userId;
        $this->courseId = $courseId;
    }
}