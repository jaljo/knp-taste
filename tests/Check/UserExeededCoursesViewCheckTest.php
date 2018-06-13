<?php

namespace App\Tests\Check;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Check\UserExeededCoursesViewCheck;

class UserExeededCoursesViewCheckTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * @before
     */
    public function setUp()
    {
        $this->user = $this->createMock(User::class);
        $this->user->method("getViewedCourses")
             ->willReturn([1, 2, 3]);
    }

    /**
     * Ensure check return true when user's course exeed given parmeter value
     */
    public function testCheckSuccess()
    {
        $check = new UserExeededCoursesViewCheck(1);

        $this->assertTrue($check->check($this->user));
    }

    /**
     * Ensure check return false when user's course don't exeed given parmeter value
     */
    public function testCheckFailure()
    {
        $check = new UserExeededCoursesViewCheck(10);

        $this->assertFalse($check->check($this->user));
    }
}
