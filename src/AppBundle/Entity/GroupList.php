<?php

namespace AppBundle\Entity;

/**
 * GroupList
 */
class GroupList
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $room;

    /**
     * @var string|null
     */
    private $hour;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\UserLector
     */
    private $userLector;

    /**
     * @var \AppBundle\Entity\School
     */
    private $school;

    /**
     * @var \AppBundle\Entity\Week
     */
    private $day;


    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return GroupList
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set room.
     *
     * @param string|null $room
     *
     * @return GroupList
     */
    public function setRoom($room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room.
     *
     * @return string|null
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set hour.
     *
     * @param string|null $hour
     *
     * @return GroupList
     */
    public function setHour($hour = null)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour.
     *
     * @return string|null
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userLector.
     *
     * @param \AppBundle\Entity\UserLector|null $userLector
     *
     * @return GroupList
     */
    public function setUserLector(\AppBundle\Entity\UserLector $userLector = null)
    {
        $this->userLector = $userLector;

        return $this;
    }

    /**
     * Get userLector.
     *
     * @return \AppBundle\Entity\UserLector|null
     */
    public function getUserLector()
    {
        return $this->userLector;
    }

    /**
     * Set school.
     *
     * @param \AppBundle\Entity\School|null $school
     *
     * @return GroupList
     */
    public function setSchool(\AppBundle\Entity\School $school = null)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school.
     *
     * @return \AppBundle\Entity\School|null
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set day.
     *
     * @param \AppBundle\Entity\Week|null $day
     *
     * @return GroupList
     */
    public function setDay(\AppBundle\Entity\Week $day = null)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day.
     *
     * @return \AppBundle\Entity\Week|null
     */
    public function getDay()
    {
        return $this->day;
    }
}
