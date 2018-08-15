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
    private $cost;

    /**
     * @var string|null
     */
    private $sumCost;

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
     * Set cost.
     *
     * @param string|null $cost
     *
     * @return GroupList
     */
    public function setCost($cost = null)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost.
     *
     * @return string|null
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set sumCost.
     *
     * @param string|null $sumCost
     *
     * @return GroupList
     */
    public function setSumCost($sumCost = null)
    {
        $this->sumCost = $sumCost;

        return $this;
    }

    /**
     * Get sumCost.
     *
     * @return string|null
     */
    public function getSumCost()
    {
        return $this->sumCost;
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
}
