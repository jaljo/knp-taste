<?php

namespace App\Tests\Check;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Check\UserWaitedEnoughCheck;
use DateTime;
use DateInterval;

class UserWaitedEnoughCheckTest extends TestCase
{
   /**
     * @var User
     */
    private $user;

   /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @before
     */
    public function setUp()
    {
        $this->user = $this->createMock(User::class);
        $this->userRepository = $this->createMock(UserRepository::class);
    }

    /**
     * Ensure check return true when user's has waited enough time before
     * his last video visualization
     */
    public function testCheckSuccess()
    {
        // simulate that the last course viewed by the user was 1 year ago...
        $oldDate = new DateTime();
        $oldDate->sub(new DateInterval("P1Y"));

        $this->userRepository->method('getUserLastCourseVisualizationDate')
            ->willReturn($oldDate);

        $check = new UserWaitedEnoughCheck($this->userRepository, 1);

        $this->assertTrue($check->check($this->user));
    }

    /**
     * Ensure check return false when user's has not waited enough time before
     * his last video visualization
     */
    public function testCheckFailure()
    {
        $this->userRepository->method('getUserLastCourseVisualizationDate')
            ->willReturn(new DateTime());

        $check = new UserWaitedEnoughCheck($this->userRepository, 1);

        $this->assertFalse($check->check($this->user));
    }
}
