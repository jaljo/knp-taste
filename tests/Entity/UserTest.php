<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

/**
 * Description of User
 *
 * @author root
 */
class UserTest extends TestCase
{
    /**
     * Ensure we get true when user is an admin.
     */
    public function testIsAdminSuccess()
    {
        $user = new User("foo.bar@knplabs.com", "foo", "bar", ["ROLE_ADMIN"]);

        $this->assertTrue($user->isAdmin());
    }

    /**
     * Ensure we get true when user is not an admin.
     */
    public function testIsAdminFailure()
    {
        $user = new User("foo.bar@knplabs.com", "foo", "bar", ["ROLE_USER"]);

        $this->assertFalse($user->isAdmin());
    }
}
