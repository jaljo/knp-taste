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
     * @var int 
     */    
    public $courseId;
    
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