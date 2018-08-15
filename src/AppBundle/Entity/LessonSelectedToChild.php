<?php

namespace AppBundle\Entity;

/**
 * LessonSelectedToChild
 */
class LessonSelectedToChild
{
    /**
     * @var int|null
     */
    private $status = '1';

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Child
     */
    private $child;

    /**
     * @var \AppBundle\Entity\GroupLesson
     */
    private $groupLesson;


    /**
     * Set status.
     *
     * @param int|null $status
     *
     * @return LessonSelectedToChild
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
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
     * @return LessonSelectedToChild
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
     * Set groupLesson.
     *
     * @param \AppBundle\Entity\GroupLesson|null $groupLesson
     *
     * @return LessonSelectedToChild
     */
    public function setGroupLesson(\AppBundle\Entity\GroupLesson $groupLesson = null)
    {
        $this->groupLesson = $groupLesson;

        return $this;
    }

    /**
     * Get groupLesson.
     *
     * @return \AppBundle\Entity\GroupLesson|null
     */
    public function getGroupLesson()
    {
        return $this->groupLesson;
    }
}
