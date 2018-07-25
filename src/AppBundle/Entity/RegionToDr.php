<?php

namespace AppBundle\Entity;

/**
 * RegionToDr
 */
class RegionToDr
{
    /**
     * @var int|null
     */
    private $regionId;

    /**
     * @var int|null
     */
    private $drId;

    /**
     * @var int
     */
    private $id;


    /**
     * Set regionId.
     *
     * @param int|null $regionId
     *
     * @return RegionToDr
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
     * Set drId.
     *
     * @param int|null $drId
     *
     * @return RegionToDr
     */
    public function setDrId($drId = null)
    {
        $this->drId = $drId;

        return $this;
    }

    /**
     * Get drId.
     *
     * @return int|null
     */
    public function getDrId()
    {
        return $this->drId;
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
