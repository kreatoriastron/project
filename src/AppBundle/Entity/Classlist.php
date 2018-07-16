<?php

namespace AppBundle\Entity;

/**
 * Classlist
 */
class Classlist
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\School
     */
    private $school;


    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Classlist
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set school.
     *
     * @param \AppBundle\Entity\School|null $school
     *
     * @return Classlist
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
}
