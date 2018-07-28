<?php

namespace AppBundle\Entity;

/**
 * Child
 */
class Child
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $surname;

    /**
     * @var int|null
     */
    private $classDigit;

    /**
     * @var string|null
     */
    private $classLetter;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\UserParent
     */
    private $parent;

    /**
     * @var \AppBundle\Entity\School
     */
    private $school;


    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Child
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
     * Set surname.
     *
     * @param string|null $surname
     *
     * @return Child
     */
    public function setSurname($surname = null)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname.
     *
     * @return string|null
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set classDigit.
     *
     * @param int|null $classDigit
     *
     * @return Child
     */
    public function setClassDigit($classDigit = null)
    {
        $this->classDigit = $classDigit;

        return $this;
    }

    /**
     * Get classDigit.
     *
     * @return int|null
     */
    public function getClassDigit()
    {
        return $this->classDigit;
    }

    /**
     * Set classLetter.
     *
     * @param string|null $classLetter
     *
     * @return Child
     */
    public function setClassLetter($classLetter = null)
    {
        $this->classLetter = $classLetter;

        return $this;
    }

    /**
     * Get classLetter.
     *
     * @return string|null
     */
    public function getClassLetter()
    {
        return $this->classLetter;
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
     * Set parent.
     *
     * @param \AppBundle\Entity\UserParent|null $parent
     *
     * @return Child
     */
    public function setParent(\AppBundle\Entity\UserParent $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent.
     *
     * @return \AppBundle\Entity\UserParent|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set school.
     *
     * @param \AppBundle\Entity\School|null $school
     *
     * @return Child
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
