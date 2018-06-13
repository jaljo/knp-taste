<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Course;
use App\Entity\UserCourse;

class User implements UserInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var UserCourse[]
     */
    private $viewedCourses;

    /**
     * @param string $email
     * @param string $username
     * @param string $password
     * @parma array $roles
     */
    public function __construct(string $email, string $username, string $password, array $roles)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
        $this->viewedCourses = new ArrayCollection();
    }

    /**
     * @param string $email
     * @param string $username
     * @param string $password
     * @parma array $roles
     */
    public static function register(string $email, string $username, string $password, array $roles)
    {
        return new self($email, $username, $password, $roles);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * This methods checks if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return in_array("ROLE_ADMIN", $this->roles);
    }

    /**
     * This mthods returns null as we use the bcrypt encoder, we don't need salt.
     *
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }

    /**
     * This method overrides plaintext password with encoded one.
     *
     * @param string $encodedPassword
     * @return \App\Entity\User
     */
    public function setPassword(string $encodedPassword): User
    {
        $this->password = $encodedPassword;
        return $this;
    }

    public function getViewedCourses()
    {
        return $this->viewedCourses;
    }

    /**
     * @todo to tight coupled to UserCourse ?
     *
     * @param Course $course
     * @return \App\Entity\User
     */
    public function takeCourse(Course $course): self
    {
        $userCourse = UserCourse::take($course, $this);
        $this->viewedCourses->add($userCourse);

        return $this;
    }
}
