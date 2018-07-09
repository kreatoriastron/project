<?php

namespace AppBundle\Entity;

/**
 * ClassToLector
 */
class ClassToLector
{
    /**
     * @var int|null
     */
    private $classId;

    /**
     * @var int|null
     */
    private $lectorId;

    /**
     * @var int
     */
    private $id;


    /**
     * Set classId.
     *
     * @param int|null $classId
     *
     * @return ClassToLector
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
     * Set lectorId.
     *
     * @param int|null $lectorId
     *
     * @return ClassToLector
     */
    public function setLectorId($lectorId = null)
    {
        $this->lectorId = $lectorId;

        return $this;
    }

    /**
     * Get lectorId.
     *
     * @return int|null
     */
    public function getLectorId()
    {
        return $this->lectorId;
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
