<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\PersistentCollection;

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
     * @var UserCourse 
     */        
    private $viewedCourses;
    
    /**
     * @param string $email
     * @param string $username
     * @param string $password
     */
    private function __construct(string $email, string $username, string $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }
    
    /**
     * @param string $email
     * @param string $username
     * @param string $password
     */    
    public static function register(string $email, string $username, string $password)
    {
        return new self($email, $username, $password);
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
        return array("ROLE_USER");
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
    
    /**
     * @return PersistentCollection
     */
    public function getViewedCourses(): PersistentCollection
    {
        return $this->viewedCourses;
    }    
}
