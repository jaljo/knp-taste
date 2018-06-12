<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 */
class Course
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=125)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $videoSrc;

    /**
     * @var UserCourse 
     * @ORM\OneToMany(targetEntity="App\Entity\UserCourse", mappedBy="course")
     */   
    private $usersVisualizations;
    
    /**
     * @param string $name
     * @param string $videoSrc
     */
    public function __construct(string $name, string $videoSrc)
    {
        $this->name = $name;
        $this->videoSrc = $videoSrc;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVideo(): string
    {
        return $this->videoSrc;
    }
    
    /**
     * @return PersistentCollection
     */
    public function getUsersVisualizations(): PersistentCollection
    {
        return $this->usersVisualizations;
    }
}
