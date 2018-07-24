<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserDr
 *
 * @ORM\Table(name="user_dr", indexes={@ORM\Index(name="dr_user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class UserDr
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="employee_type", type="integer", nullable=true)
     */
    private $employeeType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contract_terms", type="string", length=1000, nullable=true)
     */
    private $contractTerms;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contract", type="string", length=30, nullable=true)
     */
    private $contract;

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
