<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messanger
 *
 * @ORM\Table(name="messanger")
 * @ORM\Entity
 */
class Messanger
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="from", type="string", length=40, nullable=true)
     */
    private $from;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to", type="string", length=40, nullable=true)
     */
    private $to;

    /**
     * @var string|null
     *
     * @ORM\Column(name="message", type="string", length=1000, nullable=true)
     */
    private $message;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var int|null
     *
     * @ORM\Column(name="read", type="integer", nullable=true)
     */
    private $read;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
