<?php

namespace AppBundle\Entity;

/**
 * SchoolToDr
 */
class SchoolToDr
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\UserDr
     */
    private $userDr;

    /**
     * @var \AppBundle\Entity\School
     */
    private $school;


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
     * Set userDr.
     *
     * @param \AppBundle\Entity\UserDr|null $userDr
     *
     * @return SchoolToDr
     */
    public function setUserDr(\AppBundle\Entity\UserDr $userDr = null)
    {
        $this->userDr = $userDr;

        return $this;
    }

    /**
     * Get userDr.
     *
     * @return \AppBundle\Entity\UserDr|null
     */
    public function getUserDr()
    {
        return $this->userDr;
    }

    /**
     * Set school.
     *
     * @param \AppBundle\Entity\School|null $school
     *
     * @return SchoolToDr
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
