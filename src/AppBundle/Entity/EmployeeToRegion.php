<?php

namespace AppBundle\Entity;

/**
 * EmployeeToRegion
 */
class EmployeeToRegion
{
    /**
     * @var int|null
     */
    private $userId;

    /**
     * @var int|null
     */
    private $regionId;

    /**
     * @var int
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
