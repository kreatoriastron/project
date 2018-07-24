<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserLector
 *
 * @ORM\Table(name="user_lector", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class UserLector
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="salary", type="integer", nullable=true)
     */
    private $salary;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contract", type="string", length=40, nullable=true)
     */
    private $contract;

    /**
     * @var int|null
     *
     * @ORM\Column(name="employee_type", type="integer", nullable=true, options={"comment"="student, zdrowotne, wszystie stawki"})
     */
    private $employeeType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="language_level", type="integer", nullable=true)
     */
    private $languageLevel;

    /**
     * @var float|null
     *
     * @ORM\Column(name="contract_ending_date", type="float", precision=10, scale=0, nullable=true)
     */
    private $contractEndingDate;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AppUsers
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AppUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
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
