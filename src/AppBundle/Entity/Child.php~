<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Child
 *
 * @ORM\Table(name="child")
 * @ORM\Entity
 */
class Child
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="surname", type="string", length=30, nullable=true)
     */
    private $surname;

    /**
     * @var int|null
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="group_id", type="integer", nullable=true)
     */
    private $groupId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="school_id", type="integer", nullable=true)
     */
    private $schoolId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="class_digit", type="integer", nullable=true)
     */
    private $classDigit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="class_letter", type="string", length=11, nullable=true)
     */
    private $classLetter;

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
