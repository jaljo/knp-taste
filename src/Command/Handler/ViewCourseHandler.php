<?php

namespace App\Command\Handler;

use App\Command\Handler\CommandHandler;
use App\Command\Command;
use App\Check\UserCheck;

class ViewCourseHandler implements CommandHandler
{
    /**
     * @var UserCheck 
     */
    private $userIsAdminCheck;
            
    /**
     * @var UserCheck 
     */    
    private $userExeededCoursesViewCheck;
            
    /**
     * @var UserCheck 
     */    
    private $userWaitedEnough;
    
    /**
     * @param UserCheck $userIsAdminCheck
     * @param UserCheck $userExeededCoursesViewCheck
     * @param UserCheck $userWaitedEnough
     */
    public function __construct(
        UserCheck $userIsAdminCheck,
        UserCheck $userExeededCoursesViewCheck,
        UserCheck $userWaitedEnough
    )
    {
        $this->userIsAdminCheck = $userIsAdminCheck;
        $this->userExeededCoursesViewCheck = $userExeededCoursesViewCheck;
        $this->userWaitedEnough = $userWaitedEnough;
    }
    
    public function handle(Command $command)
    {        
        if(true === $this->userIsAdminCheck($command->userId)) {
            
        }
        
        if(false === $this->userExeededCoursesViewCheck($command->userId)) {
            
        }
        
        if(true === $this->userWaitedEnough($command->userId)) {
            
        }
    }
}
