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
    private $classId;

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
     * Set classId.
     *
     * @param int|null $classId
     *
     * @return Child
     */
    public function setClassId($classId = null)
    {
        $this->classId = $classId;

        return $this;
    }

    /**
     * Get classId.
     *
     * @return int|null
     */
    public function getClassId()
    {
        return $this->classId;
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
