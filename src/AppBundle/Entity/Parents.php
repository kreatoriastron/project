<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parents
 *
 * @ORM\Table(name="parents", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_880E0D76F85E0677", columns={"username"}), @ORM\UniqueConstraint(name="UNIQ_880E0D76E7927C74", columns={"email"})})
 * @ORM\Entity
 */
class Parents
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=25, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64, nullable=false)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=60, nullable=true)
     */
    private $email;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @var string|null
     *
     * @ORM\Column(name="class", type="string", length=4, nullable=true)
     */
    private $class;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set username.
     *
     * @param string $username
     *
     * @return Parents
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return Parents
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Parents
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive.
     *
     * @param bool|null $isActive
     *
     * @return Parents
     */
    public function setIsActive($isActive = null)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive.
     *
     * @return bool|null
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set class.
     *
     * @param string|null $class
     *
     * @return Parents
     */
    public function setClass($class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class.
     *
     * @return string|null
     */
    public function getClass()
    {
        return $this->class;
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
