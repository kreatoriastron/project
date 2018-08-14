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
    private $fromUser;

    /**
     * @var string|null
     */
    private $toUser;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var \DateTime|null
     */
    private $sendDate;

    /**
     * @var int|null
     */
    private $type;

    /**
     * @var int|null
     */
    private $status;

    /**
     * @var int
     */
    private $id;


    /**
     * Set fromUser.
     *
     * @param string|null $fromUser
     *
     * @return Messanger
     */
    public function setFromUser($fromUser = null)
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * Get fromUser.
     *
     * @return string|null
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * Set toUser.
     *
     * @param string|null $toUser
     *
     * @return Messanger
     */
    public function setToUser($toUser = null)
    {
        $this->toUser = $toUser;

        return $this;
    }

    /**
     * Get toUser.
     *
     * @return string|null
     */
    public function getToUser()
    {
        return $this->toUser;
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
     * Set sendDate.
     *
     * @param \DateTime|null $sendDate
     *
     * @return Messanger
     */
    public function setSendDate($sendDate = null)
    {
        $this->sendDate = $sendDate;

        return $this;
    }

    /**
     * Get sendDate.
     *
     * @return \DateTime|null
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * Set type.
     *
     * @param int|null $type
     *
     * @return Messanger
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set status.
     *
     * @param int|null $status
     *
     * @return Messanger
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
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
