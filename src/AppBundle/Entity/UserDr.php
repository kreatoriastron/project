<?php

namespace AppBundle\Entity;

/**
 * UserDr
 */
class UserDr
{
    /**
     * @var int|null
     */
    private $employeeType;

    /**
     * @var string|null
     */
    private $contractTerms;

    /**
     * @var string|null
     */
    private $contract;

    /**
     * @var float|null
     */
    private $contractEndingDate;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AppUsers
     */
    private $user;


    /**
     * Set employeeType.
     *
     * @param int|null $employeeType
     *
     * @return UserDr
     */
    public function setEmployeeType($employeeType = null)
    {
        $this->employeeType = $employeeType;

        return $this;
    }

    /**
     * Get employeeType.
     *
     * @return int|null
     */
    public function getEmployeeType()
    {
        return $this->employeeType;
    }

    /**
     * Set contractTerms.
     *
     * @param string|null $contractTerms
     *
     * @return UserDr
     */
    public function setContractTerms($contractTerms = null)
    {
        $this->contractTerms = $contractTerms;

        return $this;
    }

    /**
     * Get contractTerms.
     *
     * @return string|null
     */
    public function getContractTerms()
    {
        return $this->contractTerms;
    }

    /**
     * Set contract.
     *
     * @param string|null $contract
     *
     * @return UserDr
     */
    public function setContract($contract = null)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract.
     *
     * @return string|null
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set contractEndingDate.
     *
     * @param float|null $contractEndingDate
     *
     * @return UserDr
     */
    public function setContractEndingDate($contractEndingDate = null)
    {
        $this->contractEndingDate = $contractEndingDate;

        return $this;
    }

    /**
     * Get contractEndingDate.
     *
     * @return float|null
     */
    public function getContractEndingDate()
    {
        return $this->contractEndingDate;
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
     * @return UserDr
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
