<?php

namespace AppBundle\Entity;

/**
 * Week
 */
class Week
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var int
     */
    private $id;


    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Week
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
