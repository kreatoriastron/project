<?php

namespace LoginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClassList
 *
 * @ORM\Table(name="class_list")
 * @ORM\Entity
 */
class ClassList
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="school", type="string", length=20, nullable=true)
     */
    private $school;

    /**
     * @var string|null
     *
     * @ORM\Column(name="class", type="string", length=10, nullable=true)
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


}
