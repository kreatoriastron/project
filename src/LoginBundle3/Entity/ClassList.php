<?php

namespace LoginBundle\Entity;

/**
 * ClassList
 */
class ClassList
{
    /**
     * @var string|null
     */
    private $school;

    /**
     * @var string|null
     */
    private $class;

    /**
     * @var int
     */
    private $id;


    /**
     * Set school.
     *
     * @param string|null $school
     *
     * @return ClassList
     */
    public function setSchool($school = null)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school.
     *
     * @return string|null
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set class.
     *
     * @param string|null $class
     *
     * @return ClassList
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
