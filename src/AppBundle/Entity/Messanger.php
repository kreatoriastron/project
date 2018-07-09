<?php

namespace AppBundle\Entity;

/**
 * Messanger
 */
class Messanger
{
    /**
     * @var string|null
     */
    private $from;

    /**
     * @var string|null
     */
    private $to;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var \DateTime|null
     */
    private $date;

    /**
     * @var int|null
     */
    private $read;

    /**
     * @var int
     */
    private $id;


    /**
     * Set from.
     *
     * @param string|null $from
     *
     * @return Messanger
     */
    public function setFrom($from = null)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from.
     *
     * @return string|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to.
     *
     * @param string|null $to
     *
     * @return Messanger
     */
    public function setTo($to = null)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to.
     *
     * @return string|null
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set message.
     *
     * @param string|null $message
     *
     * @return Messanger
     */
    public function setMessage($message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set date.
     *
     * @param \DateTime|null $date
     *
     * @return Messanger
     */
    public function setDate($date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set read.
     *
     * @param int|null $read
     *
     * @return Messanger
     */
    public function setRead($read = null)
    {
        $this->read = $read;

        return $this;
    }

    /**
     * Get read.
     *
     * @return int|null
     */
    public function getRead()
    {
        return $this->read;
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
