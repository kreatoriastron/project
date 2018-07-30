<?php

namespace AppBundle\Entity;

/**
 * Lesson
 */
class Lesson
{
    /**
     * @var string|null
     */
    private $topic;

    /**
     * @var string|null
     */
    private $date;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\GroupList
     */
    private $group;


    /**
     * Set topic.
     *
     * @param string|null $topic
     *
     * @return Lesson
     */
    public function setTopic($topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic.
     *
     * @return string|null
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set date.
     *
     * @param string|null $date
     *
     * @return Lesson
     */
    public function setDate($date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return string|null
     */
    public function getDate()
    {
        return $this->date;
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
     * @return Lesson
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
}
