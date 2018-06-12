<?php

namespace App\Command\Handler;

use App\Command\Handler\CommandHandler;
use App\Command\Command;
use App\Check\UserCheck;

class ViewCourseCommandHandler implements CommandHandler
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
        var_dump($this->userWaitedEnough->check($command->userId));
        exit;
        
        if(true === $this->userIsAdminCheck->check($command->userId)) {
            echo 'isAdmin !';
        }
        
        if(false === $this->userExeededCoursesViewCheck->check($command->userId)) {
            echo 'limit not exeeded !';
        }
        
        if(true === $this->userWaitedEnough->check($command->userId)) {
            echo 'has waited enough !';
        }
    }
}
