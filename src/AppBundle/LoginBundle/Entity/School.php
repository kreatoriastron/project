<?php

namespace LoginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * School
 *
 * @ORM\Table(name="school")
 * @ORM\Entity
 */
class School
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=10, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="number", type="string", length=10, nullable=true)
     */
    private $number;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}
