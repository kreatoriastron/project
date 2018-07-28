<?php

namespace AppBundle\Entity;

/**
 * City
 */
class City
{
    /**
     * @var int|null
     */
    private $powiat;

    /**
     * @var int|null
     */
    private $gmina;

    /**
     * @var string|null
     */
    private $city;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Wojewodztwo
     */
    private $wojewodztwo;


    /**
     * Set powiat.
     *
     * @param int|null $powiat
     *
     * @return City
     */
    public function setPowiat($powiat = null)
    {
        $this->powiat = $powiat;

        return $this;
    }

    /**
     * Get powiat.
     *
     * @return int|null
     */
    public function getPowiat()
    {
        return $this->powiat;
    }

    /**
     * Set gmina.
     *
     * @param int|null $gmina
     *
     * @return City
     */
    public function setGmina($gmina = null)
    {
        $this->gmina = $gmina;

        return $this;
    }

    /**
     * Get gmina.
     *
     * @return int|null
     */
    public function getGmina()
    {
        return $this->gmina;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return City
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
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
     * Set wojewodztwo.
     *
     * @param \AppBundle\Entity\Wojewodztwo|null $wojewodztwo
     *
     * @return City
     */
    public function setWojewodztwo(\AppBundle\Entity\Wojewodztwo $wojewodztwo = null)
    {
        $this->wojewodztwo = $wojewodztwo;

        return $this;
    }

    /**
     * Get wojewodztwo.
     *
     * @return \AppBundle\Entity\Wojewodztwo|null
     */
    public function getWojewodztwo()
    {
        return $this->wojewodztwo;
    }
}
