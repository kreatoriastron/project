<?php

namespace AppBundle\Entity;

/**
 * LessonTimetable
 */
class LessonTimetable
{
    /**
     * @var int|null
     */
    private $classId;

    /**
     * @var string|null
     */
    private $month;

    /**
     * @var string|null
     */
    private $lessonAmount;

    /**
     * @var string|null
     */
    private $cost;

    /**
     * @var string|null
     */
    private $paymentDay;

    /**
     * @var int
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
