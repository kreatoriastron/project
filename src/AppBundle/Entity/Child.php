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
    private $parentId;

    /**
     * @var int|null
     */
    private $groupId;

    /**
     * @var int|null
     */
    private $schoolId;

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
     * Set parentId.
     *
     * @param int|null $parentId
     *
     * @return Child
     */
    public function setParentId($parentId = null)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId.
     *
     * @return int|null
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set groupId.
     *
     * @param int|null $groupId
     *
     * @return Child
     */
    public function setGroupId($groupId = null)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * Get groupId.
     *
     * @return int|null
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Set schoolId.
     *
     * @param int|null $schoolId
     *
     * @return Child
     */
    public function setSchoolId($schoolId = null)
    {
        $this->schoolId = $schoolId;

        return $this;
    }

    /**
     * Get schoolId.
     *
     * @return int|null
     */
    public function getSchoolId()
    {
        return $this->schoolId;
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
}
