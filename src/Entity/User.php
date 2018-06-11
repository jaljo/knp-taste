<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string 
     * @ORM\Column(type="string", length="100")
     */
    private $username;
    
    /**
     * @var string 
     * @ORM\Column(type="string", length="100")
     */    
    private $password;

    /**
     * @param string $username
     * @param string $password
     */
    private function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    
    /**
     * @param string $username
     * @param string $password
     */    
    public static function register(string $username, string $password)
    {
        self($username, $password);
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
        return array("USER_ADMIN");
    }

    /**
     * This returns null as we use the bcrypt encoder.
     * @return null
     */
    public function getSalt(): null
    {
        return null;
    }
    
    public function eraseCredentials(): void 
    {
    }    
}
