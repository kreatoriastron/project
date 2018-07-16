<?php

namespace AppBundle\Entity;

/**
 * School
 */
class School
{
    /**
     * @var string|null
     */
    private $city;

    /**
     * @var string|null
     */
    private $number;

    /**
     * @var int
     */
    private $id;


    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return School
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
     * Set number.
     *
     * @param string|null $number
     *
     * @return School
     */
    public function setNumber($number = null)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number.
     *
     * @return string|null
     */
    public function getNumber()
    {
        return $this->number;
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
}
