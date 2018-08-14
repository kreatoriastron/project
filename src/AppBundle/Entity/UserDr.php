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
     * @var string|null
     */
    private $bankNumber;

    /**
     * @var string|null
     */
    private $raCity;

    /**
     * @var string|null
     */
    private $raZipCode;

    /**
     * @var string|null
     */
    private $raStreet;

    /**
     * @var string|null
     */
    private $raBuilding;

    /**
     * @var string|null
     */
    private $raApartment;

    /**
     * @var string|null
     */
    private $caCity;

    /**
     * @var string|null
     */
    private $caZipCode;

    /**
     * @var string|null
     */
    private $caStreet;

    /**
     * @var string|null
     */
    private $caBuilding;

    /**
     * @var string|null
     */
    private $caApartment;

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
     * Set bankNumber.
     *
     * @param string|null $bankNumber
     *
     * @return UserDr
     */
    public function setBankNumber($bankNumber = null)
    {
        $this->bankNumber = $bankNumber;

        return $this;
    }

    /**
     * Get bankNumber.
     *
     * @return string|null
     */
    public function getBankNumber()
    {
        return $this->bankNumber;
    }

    /**
     * Set raCity.
     *
     * @param string|null $raCity
     *
     * @return UserDr
     */
    public function setRaCity($raCity = null)
    {
        $this->raCity = $raCity;

        return $this;
    }

    /**
     * Get raCity.
     *
     * @return string|null
     */
    public function getRaCity()
    {
        return $this->raCity;
    }

    /**
     * Set raZipCode.
     *
     * @param string|null $raZipCode
     *
     * @return UserDr
     */
    public function setRaZipCode($raZipCode = null)
    {
        $this->raZipCode = $raZipCode;

        return $this;
    }

    /**
     * Get raZipCode.
     *
     * @return string|null
     */
    public function getRaZipCode()
    {
        return $this->raZipCode;
    }

    /**
     * Set raStreet.
     *
     * @param string|null $raStreet
     *
     * @return UserDr
     */
    public function setRaStreet($raStreet = null)
    {
        $this->raStreet = $raStreet;

        return $this;
    }

    /**
     * Get raStreet.
     *
     * @return string|null
     */
    public function getRaStreet()
    {
        return $this->raStreet;
    }

    /**
     * Set raBuilding.
     *
     * @param string|null $raBuilding
     *
     * @return UserDr
     */
    public function setRaBuilding($raBuilding = null)
    {
        $this->raBuilding = $raBuilding;

        return $this;
    }

    /**
     * Get raBuilding.
     *
     * @return string|null
     */
    public function getRaBuilding()
    {
        return $this->raBuilding;
    }

    /**
     * Set raApartment.
     *
     * @param string|null $raApartment
     *
     * @return UserDr
     */
    public function setRaApartment($raApartment = null)
    {
        $this->raApartment = $raApartment;

        return $this;
    }

    /**
     * Get raApartment.
     *
     * @return string|null
     */
    public function getRaApartment()
    {
        return $this->raApartment;
    }

    /**
     * Set caCity.
     *
     * @param string|null $caCity
     *
     * @return UserDr
     */
    public function setCaCity($caCity = null)
    {
        $this->caCity = $caCity;

        return $this;
    }

    /**
     * Get caCity.
     *
     * @return string|null
     */
    public function getCaCity()
    {
        return $this->caCity;
    }

    /**
     * Set caZipCode.
     *
     * @param string|null $caZipCode
     *
     * @return UserDr
     */
    public function setCaZipCode($caZipCode = null)
    {
        $this->caZipCode = $caZipCode;

        return $this;
    }

    /**
     * Get caZipCode.
     *
     * @return string|null
     */
    public function getCaZipCode()
    {
        return $this->caZipCode;
    }

    /**
     * Set caStreet.
     *
     * @param string|null $caStreet
     *
     * @return UserDr
     */
    public function setCaStreet($caStreet = null)
    {
        $this->caStreet = $caStreet;

        return $this;
    }

    /**
     * Get caStreet.
     *
     * @return string|null
     */
    public function getCaStreet()
    {
        return $this->caStreet;
    }

    /**
     * Set caBuilding.
     *
     * @param string|null $caBuilding
     *
     * @return UserDr
     */
    public function setCaBuilding($caBuilding = null)
    {
        $this->caBuilding = $caBuilding;

        return $this;
    }

    /**
     * Get caBuilding.
     *
     * @return string|null
     */
    public function getCaBuilding()
    {
        return $this->caBuilding;
    }

    /**
     * Set caApartment.
     *
     * @param string|null $caApartment
     *
     * @return UserDr
     */
    public function setCaApartment($caApartment = null)
    {
        $this->caApartment = $caApartment;

        return $this;
    }

    /**
     * Get caApartment.
     *
     * @return string|null
     */
    public function getCaApartment()
    {
        return $this->caApartment;
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
