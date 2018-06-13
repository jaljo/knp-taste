<?php

namespace App\Tests\Command\Handler;

use PHPUnit\Framework\TestCase;
use Exception;
use App\Check\UserExeededCoursesViewCheck;
use App\Check\UserWaitedEnoughCheck;
use App\Entity\User;
use App\Entity\Course;
use App\Repository\UserRepository;
use App\Command\ViewCourseCommand;
use App\Command\Handler\ViewCourseCommandHandler;

class ViewCourseCommandHandlerTest extends TestCase
{
    private $user;
    private $command;

   /**
     * @var UserRepository
     */
    private $userRepository;

    private $userExeededCoursesViewCheck;

    private $userWaitedEnoughCheck;

    /**
     * @before
     */
    public function setUp()
    {
        // mocks
        $this->user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->setMethods(["takeCourse", "isAdmin"])
            ->getMock();

        $this->command = $this->createMock(ViewCourseCommand::class);
        $this->command->user = $this->user;
        $this->command->course = $this->createMock(Course::class);

        $this->userRepository = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(["save"])
            ->getMock();

        $this->userExeededCoursesViewCheck = $this->createMock(UserExeededCoursesViewCheck::class);
        $this->userWaitedEnoughCheck = $this->createMock(UserWaitedEnoughCheck::class);

        // under test object
        $this->handler = new ViewCourseCommandHandler(
            $this->userExeededCoursesViewCheck,
            $this->userWaitedEnoughCheck,
            $this->userRepository
        );
    }

    /**
     * Ensure that an admin user successfully take course.
     */
    public function testHandleAdminSuccess()
    {
        $this->user->method("isAdmin")->willReturn(true);
        $this->user->expects($this->once())->method("takeCourse");
        $this->userRepository->expects($this->once())->method("save");

        $this->handler->handle($this->command);
    }

//    public function testHandleUserSuccess()
//    {
//        $this->user->method("isAdmin")->willReturn(false);
//    }
//
//    public function testHandleUserFailure()
//    {
//        $this->user->method("isAdmin")->willReturn(false);
//    }
}
