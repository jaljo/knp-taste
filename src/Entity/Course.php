<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

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
        $this->usersVisualizations = new ArrayCollection();
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
    public function getVideoSrc(): string
    {
        return $this->videoSrc;
    }

    public function getUsersVisualizations()
    {
        return $this->usersVisualizations;
    }
}
