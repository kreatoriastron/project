<?php

namespace AppBundle\Entity;

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



    /**
     * Set classId.
     *
     * @param int|null $classId
     *
     * @return LessonTimetable
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
     * Set month.
     *
     * @param string|null $month
     *
     * @return LessonTimetable
     */
    public function setMonth($month = null)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month.
     *
     * @return string|null
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set lessonAmount.
     *
     * @param string|null $lessonAmount
     *
     * @return LessonTimetable
     */
    public function setLessonAmount($lessonAmount = null)
    {
        $this->lessonAmount = $lessonAmount;

        return $this;
    }

    /**
     * Get lessonAmount.
     *
     * @return string|null
     */
    public function getLessonAmount()
    {
        return $this->lessonAmount;
    }

    /**
     * Set cost.
     *
     * @param string|null $cost
     *
     * @return LessonTimetable
     */
    public function setCost($cost = null)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost.
     *
     * @return string|null
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set paymentDay.
     *
     * @param string|null $paymentDay
     *
     * @return LessonTimetable
     */
    public function setPaymentDay($paymentDay = null)
    {
        $this->paymentDay = $paymentDay;

        return $this;
    }

    /**
     * Get paymentDay.
     *
     * @return string|null
     */
    public function getPaymentDay()
    {
        return $this->paymentDay;
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
