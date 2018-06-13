<?php

namespace App\Command\Handler;

use App\Command\Handler\CommandHandler;
use App\Command\Command;
use App\Check\UserCheck;
use App\Repository\UserRepository;
use Exception;

class ViewCourseCommandHandler implements CommandHandler
{            
    /**
     * @var UserCheck 
     */    
    private $userExeededCoursesViewCheck;
            
    /**
     * @var UserCheck 
     */    
    private $userWaitedEnough;
    
    /**
     * @var UserRepository 
     */
    private $userRepository;
    
    /**
     * @param UserCheck $userExeededCoursesViewCheck
     * @param UserCheck $userWaitedEnough
     * @parm UserRepository $userRepository
     */
    public function __construct(
        UserCheck $userExeededCoursesViewCheck,
        UserCheck $userWaitedEnough,
        UserRepository $userRepository
    )
    {
        $this->userExeededCoursesViewCheck = $userExeededCoursesViewCheck;
        $this->userWaitedEnough = $userWaitedEnough;
        $this->userRepository = $userRepository;
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
        if($command->user->isAdmin()) {
            return;
        }
        
        // for non admin user, we ensure business rules are respected
        if(
            $this->userExeededCoursesViewCheck->check($command->user) &&
            !$this->userWaitedEnough->check($command->user)
        ) {            
            throw new Exception("You've exeeded the amount of courses you can take. Wait a little bit !");
        }
        
        // persist that the user effectively take course
        $command->user->takeCourse($command->course);
        $this->userRepository->save($command->user);
    }
}
