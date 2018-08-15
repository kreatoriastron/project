<?php

namespace LoginBundle\Entity;

/**
 * LessonSchedule
 */
class LessonSchedule
{
    /**
     * @var int|null
     */
    private $classId;

    /**
     * @var string|null
     */
    private $day;

    /**
     * @var string|null
     */
    private $hour;

    /**
     * @var string|null
     */
    private $room;

    /**
     * @var int
     */
    private $id;


    /**
     * Set classId.
     *
     * @param int|null $classId
     *
     * @return LessonSchedule
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
     * Set day.
     *
     * @param string|null $day
     *
     * @return LessonSchedule
     */
    public function setDay($day = null)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day.
     *
     * @return string|null
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set hour.
     *
     * @param string|null $hour
     *
     * @return LessonSchedule
     */
    public function setHour($hour = null)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour.
     *
     * @return string|null
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set room.
     *
     * @param string|null $room
     *
     * @return LessonSchedule
     */
    public function setRoom($room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room.
     *
     * @return string|null
     */
    public function getRoom()
    {
        return $this->room;
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
