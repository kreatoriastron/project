<?php

namespace AppBundle\Entity;

/**
 * Fiche
 */
class Fiche
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
     * @var string|null
     */
    private $phone;

    /**
     * @var string|null
     */
    private $mail;

    /**
     * @var string|null
     */
    private $childName;

    /**
     * @var string|null
     */
    private $childSurname;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\School
     */
    private $school;


    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Fiche
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
     * @return Fiche
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
     * @return Fiche
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
     * @return Fiche
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
     * Set phone.
     *
     * @param string|null $phone
     *
     * @return Fiche
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mail.
     *
     * @param string|null $mail
     *
     * @return Fiche
     */
    public function setMail($mail = null)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail.
     *
     * @return string|null
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set childName.
     *
     * @param string|null $childName
     *
     * @return Fiche
     */
    public function setChildName($childName = null)
    {
        $this->childName = $childName;

        return $this;
    }

    /**
     * Get childName.
     *
     * @return string|null
     */
    public function getChildName()
    {
        return $this->childName;
    }

    /**
     * Set childSurname.
     *
     * @param string|null $childSurname
     *
     * @return Fiche
     */
    public function setChildSurname($childSurname = null)
    {
        $this->childSurname = $childSurname;

        return $this;
    }

    /**
     * Get childSurname.
     *
     * @return string|null
     */
    public function getChildSurname()
    {
        return $this->childSurname;
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
     * @return Fiche
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
