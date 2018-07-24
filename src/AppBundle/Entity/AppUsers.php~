<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppUsers
 *
 * @ORM\Table(name="app_users", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_C2502824F85E0677", columns={"username"}), @ORM\UniqueConstraint(name="UNIQ_C2502824E7927C74", columns={"email"})})
 * @ORM\Entity
 */
class AppUsers
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=254, nullable=false)
     */
    private $email;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true, options={"default"="1"})
     */
    private $isActive = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=10, nullable=false, options={"comment"="1-rodzic, 2-lektor, 2-DR, 3-admin"})
     */
    private $role;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="surname", type="string", length=20, nullable=true)
     */
    private $surname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}
