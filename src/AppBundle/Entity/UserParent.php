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
    private $agreementFile;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AppUsers
     */
    private $user;


    /**
     * Set agreementFile.
     *
     * @param string|null $agreementFile
     *
     * @return UserParent
     */
    public function setAgreementFile($agreementFile = null)
    {
        $this->agreementFile = $agreementFile;

        return $this;
    }

    /**
     * Get agreementFile.
     *
     * @return string|null
     */
    public function getAgreementFile()
    {
        return $this->agreementFile;
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
