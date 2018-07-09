<?php

namespace LoginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LessonSchedule
 *
 * @ORM\Table(name="lesson_schedule")
 * @ORM\Entity
 */
class LessonSchedule
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="class_id", type="integer", nullable=true)
     */
    private $classId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="day", type="string", length=30, nullable=true)
     */
    private $day;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hour", type="string", length=30, nullable=true)
     */
    private $hour;

    /**
     * @var string|null
     *
     * @ORM\Column(name="room", type="string", length=30, nullable=true)
     */
    private $room;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}
