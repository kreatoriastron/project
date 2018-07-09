<?php

namespace LoginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LessonTimetable
 *
 * @ORM\Table(name="lesson_timetable")
 * @ORM\Entity
 */
class LessonTimetable
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
     * @ORM\Column(name="month", type="string", length=20, nullable=true)
     */
    private $month;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lesson_amount", type="string", length=3, nullable=true)
     */
    private $lessonAmount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cost", type="string", length=10, nullable=true)
     */
    private $cost;

    /**
     * @var string|null
     *
     * @ORM\Column(name="payment_day", type="string", length=40, nullable=true)
     */
    private $paymentDay;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}
