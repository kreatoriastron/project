<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClassToLector
 *
 * @ORM\Table(name="class_to_lector")
 * @ORM\Entity
 */
class ClassToLector
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="class_id", type="integer", nullable=true)
     */
    private $classId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="lector_id", type="integer", nullable=true)
     */
    private $lectorId;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
