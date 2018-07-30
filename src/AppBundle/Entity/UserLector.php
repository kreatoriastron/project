<?php

namespace AppBundle\Entity;

/**
 * UserLector
 */
class UserLector
{
    /**
     * @var int|null
     */
    private $salary;

    /**
     * @var string|null
     */
    private $bonus;

    /**
     * @var string|null
     */
    private $contract;

    /**
     * @var int|null
     */
    private $employeeType;

    /**
     * @var int|null
     */
    private $languageLevel;

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
     * Set salary.
     *
     * @param int|null $salary
     *
     * @return UserLector
     */
    public function setSalary($salary = null)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary.
     *
     * @return int|null
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set bonus.
     *
     * @param string|null $bonus
     *
     * @return UserLector
     */
    public function setBonus($bonus = null)
    {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * Get bonus.
     *
     * @return string|null
     */
    public function getBonus()
    {
        return $this->bonus;
    }

    /**
     * Set contract.
     *
     * @param string|null $contract
     *
     * @return UserLector
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
     * Set employeeType.
     *
     * @param int|null $employeeType
     *
     * @return UserLector
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
     * Set languageLevel.
     *
     * @param int|null $languageLevel
     *
     * @return UserLector
     */
    public function setLanguageLevel($languageLevel = null)
    {
        $this->languageLevel = $languageLevel;

        return $this;
    }

    /**
     * Get languageLevel.
     *
     * @return int|null
     */
    public function getLanguageLevel()
    {
        return $this->languageLevel;
    }

    /**
     * Set contractEndingDate.
     *
     * @param float|null $contractEndingDate
     *
     * @return UserLector
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
     * @return UserLector
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
