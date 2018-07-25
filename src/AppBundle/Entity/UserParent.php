<?php

namespace AppBundle\Entity;

/**
 * UserParent
 */
class UserParent
{
    /**
     * @var string|null
     */
    private $contractFile;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AppUsers
     */
    private $user;


    /**
     * Set contractFile.
     *
     * @param string|null $contractFile
     *
     * @return UserParent
     */
    public function setContractFile($contractFile = null)
    {
        $this->contractFile = $contractFile;

        return $this;
    }

    /**
     * Get contractFile.
     *
     * @return string|null
     */
    public function getContractFile()
    {
        return $this->contractFile;
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
     * Set user.
     *
     * @param \AppBundle\Entity\AppUsers|null $user
     *
     * @return UserParent
     */
    public function setUser(\AppBundle\Entity\AppUsers $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\AppUsers|null
     */
    public function getUser()
    {
        return $this->user;
    }
}
