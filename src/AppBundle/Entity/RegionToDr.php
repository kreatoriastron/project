<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegionToDr
 *
 * @ORM\Table(name="region_to_dr")
 * @ORM\Entity
 */
class RegionToDr
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="region_id", type="integer", nullable=true)
     */
    private $regionId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dr_id", type="integer", nullable=true)
     */
    private $drId;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
