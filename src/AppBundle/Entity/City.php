<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity
 */
class City
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="wojewodztwo", type="string", length=30, nullable=true)
     */
    private $wojewodztwo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="powiat", type="string", length=30, nullable=true)
     */
    private $powiat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gmina", type="string", length=30, nullable=true)
     */
    private $gmina;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=30, nullable=true)
     */
    private $city;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set wojewodztwo.
     *
     * @param string|null $wojewodztwo
     *
     * @return City
     */
    public function setWojewodztwo($wojewodztwo = null)
    {
        $this->wojewodztwo = $wojewodztwo;

        return $this;
    }

    /**
     * Get wojewodztwo.
     *
     * @return string|null
     */
    public function getWojewodztwo()
    {
        return $this->wojewodztwo;
    }

    /**
     * Set powiat.
     *
     * @param string|null $powiat
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
     * @return string|null
     */
    public function getPowiat()
    {
        return $this->powiat;
    }

    /**
     * Set gmina.
     *
     * @param string|null $gmina
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
     * @return string|null
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
}
