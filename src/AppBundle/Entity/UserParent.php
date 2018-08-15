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
     * @var int|null
     */
    private $cost;

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
     * @var int|null
     */
    private $sumCost;

    /**
     * @var string|null
     */
    private $raCity;

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
     * Set cost.
     *
     * @param int|null $cost
     *
     * @return UserParent
     */
    public function setCost($cost = null)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost.
     *
     * @return int|null
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set raZipCode.
     *
     * @param string|null $raZipCode
     *
     * @return UserParent
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
     * @return UserParent
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
     * @return UserParent
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
     * @return UserParent
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
     * @return UserParent
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
     * @return UserParent
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
     * @return UserParent
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
     * @return UserParent
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
     * @return UserParent
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
     * Set sumCost.
     *
     * @param int|null $sumCost
     *
     * @return UserParent
     */
    public function setSumCost($sumCost = null)
    {
        $this->sumCost = $sumCost;

        return $this;
    }

    /**
     * Get sumCost.
     *
     * @return int|null
     */
    public function getSumCost()
    {
        return $this->sumCost;
    }

    /**
     * Set raCity.
     *
     * @param string|null $raCity
     *
     * @return UserParent
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
