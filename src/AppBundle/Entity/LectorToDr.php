<?php

namespace AppBundle\Entity;

/**
 * LectorToDr
 */
class LectorToDr
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
     * @var \AppBundle\Entity\UserLector
     */
    private $userLector;


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
     * @return LectorToDr
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
     * Set userLector.
     *
     * @param \AppBundle\Entity\UserLector|null $userLector
     *
     * @return LectorToDr
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
}
