<?php

namespace App\Entity;

use Doctrine\ORM\PersistentCollection;

class Course
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $videoSrc;

    /**
     * @var UserCourse 
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
