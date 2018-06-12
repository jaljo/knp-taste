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
    
    /**
     * Check against multiple conditions to determine 
     * if the user is authorized to access course video.
     * 
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command)
    {        
        // we don't throw role exception here because the symfony security layer will handle them
        if(true === $this->userIsAdminCheck->check($command->userId)) {
            return;
        }
        
        // for non admin user, we ensure business rules are respected
        if(true === $this->userExeededCoursesViewCheck->check($command->userId)) {
            if(false === $this->userWaitedEnough->check($command->userId)) {
                throw new Exception("You've exeeded the amount of courses you can take. Wait a little bit !");
            }
        }

        return;
    }
}
