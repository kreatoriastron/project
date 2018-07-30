<?php

namespace AppBundle\Entity;

/**
 * Presence
 */
class Presence
{
    /**
     * @var int|null
     */
    private $presence = '0';

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Child
     */
    private $child;

    /**
     * @var \AppBundle\Entity\GroupList
     */
    private $grouplist;

    /**
     * @var \AppBundle\Entity\Lesson
     */
    private $lesson;


    /**
     * Set presence.
     *
     * @param int|null $presence
     *
     * @return Presence
     */
    public function setPresence($presence = null)
    {
        $this->presence = $presence;

        return $this;
    }

    /**
     * Get presence.
     *
     * @return int|null
     */
    public function getPresence()
    {
        return $this->presence;
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
     * Set child.
     *
     * @param \AppBundle\Entity\Child|null $child
     *
     * @return Presence
     */
    public function setChild(\AppBundle\Entity\Child $child = null)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * Get child.
     *
     * @return \AppBundle\Entity\Child|null
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * Set grouplist.
     *
     * @param \AppBundle\Entity\GroupList|null $grouplist
     *
     * @return Presence
     */
    public function setGrouplist(\AppBundle\Entity\GroupList $grouplist = null)
    {
        $this->grouplist = $grouplist;

        return $this;
    }

    /**
     * Get grouplist.
     *
     * @return \AppBundle\Entity\GroupList|null
     */
    public function getGrouplist()
    {
        return $this->grouplist;
    }

    /**
     * Set lesson.
     *
     * @param \AppBundle\Entity\Lesson|null $lesson
     *
     * @return Presence
     */
    public function setLesson(\AppBundle\Entity\Lesson $lesson = null)
    {
        $this->lesson = $lesson;

        return $this;
    }

    /**
     * Get lesson.
     *
     * @return \AppBundle\Entity\Lesson|null
     */
    public function getLesson()
    {
        return $this->lesson;
    }
}
