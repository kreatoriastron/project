<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classlist
 *
 * @ORM\Table(name="classlist", indexes={@ORM\Index(name="class_school_id", columns={"school"})})
 * @ORM\Entity
 */
class Classlist
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=10, nullable=true)
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
     * @var \AppBundle\Entity\School
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\School")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school", referencedColumnName="id")
     * })
     */
    private $school;



    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Classlist
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

    /**
     * Set school.
     *
     * @param \AppBundle\Entity\School|null $school
     *
     * @return Classlist
     */
    public function setSchool(\AppBundle\Entity\School $school = null)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school.
     *
     * @return \AppBundle\Entity\School|null
     */
    public function getSchool()
    {
        return $this->school;
    }
}
