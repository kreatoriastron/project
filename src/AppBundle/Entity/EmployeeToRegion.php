<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeToRegion
 *
 * @ORM\Table(name="employee_to_region")
 * @ORM\Entity
 */
class EmployeeToRegion
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="region_id", type="integer", nullable=true)
     */
    private $regionId;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set userId.
     *
     * @param int|null $userId
     *
     * @return EmployeeToRegion
     */
    public function setUserId($userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set regionId.
     *
     * @param int|null $regionId
     *
     * @return EmployeeToRegion
     */
    public function setRegionId($regionId = null)
    {
        $this->regionId = $regionId;

        return $this;
    }

    /**
     * Get regionId.
     *
     * @return int|null
     */
    public function getRegionId()
    {
        return $this->regionId;
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
