<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wojewodztwo
 *
 * @ORM\Table(name="wojewodztwo")
 * @ORM\Entity
 */
class Wojewodztwo
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Wojewodztwo
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
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
