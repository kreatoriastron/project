<?php

namespace AppBundle\Entity;

/**
 * GroupLesson
 */
class GroupLesson
{
    /**
     * @var string|null
     */
    private $class;

    /**
     * @var string|null
     */
    private $hour;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\GroupList
     */
    private $group;

    /**
     * @var \AppBundle\Entity\Week
     */
    private $day;


    /**
     * Set class.
     *
     * @param string|null $class
     *
     * @return GroupLesson
     */
    public function setClass($class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class.
     *
     * @return string|null
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set hour.
     *
     * @param string|null $hour
     *
     * @return GroupLesson
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
     * Set group.
     *
     * @param \AppBundle\Entity\GroupList|null $group
     *
     * @return GroupLesson
     */
    public function setGroup(\AppBundle\Entity\GroupList $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group.
     *
     * @return \AppBundle\Entity\GroupList|null
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set day.
     *
     * @param \AppBundle\Entity\Week|null $day
     *
     * @return GroupLesson
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
