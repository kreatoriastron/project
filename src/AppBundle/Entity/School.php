<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * School
 *
 * @ORM\Table(name="school", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQUE_RSPO", columns={"rspo"})}, indexes={@ORM\Index(name="wojewodztwo", columns={"wojewodztwo"})})
 * @ORM\Entity
 */
class School
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="rspo", type="string", length=11, nullable=true)
     */
    private $rspo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="powiat", type="integer", nullable=true, options={"comment"="d"})
     */
    private $powiat;

    /**
     * @var int|null
     *
     * @ORM\Column(name="gmina", type="integer", nullable=true, options={"comment"="e"})
     */
    private $gmina;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=20, nullable=true, options={"comment"="f"})
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=11, nullable=true, options={"comment"="h"})
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true, options={"comment"="j"})
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=30, nullable=true, options={"comment"="l, m"})
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="zipcode", type="string", length=10, nullable=true, options={"comment"="n"})
     */
    private $zipcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="post", type="string", length=15, nullable=true, options={"comment"="o"})
     */
    private $post;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=12, nullable=true, options={"comment"="p"})
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="www", type="string", length=30, nullable=true, options={"comment"="r"})
     */
    private $www;

    /**
     * @var string|null
     *
     * @ORM\Column(name="publicznosc", type="string", length=15, nullable=true, options={"comment"="s"})
     */
    private $publicznosc;

    /**
     * @var int|null
     *
     * @ORM\Column(name="student_count", type="integer", nullable=true, options={"comment"="ai"})
     */
    private $studentCount;

    /**
     * @var int|null
     *
     * @ORM\Column(name="class_count", type="integer", nullable=true, options={"comment"="am"})
     */
    private $classCount;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Wojewodztwo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Wojewodztwo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="wojewodztwo", referencedColumnName="id")
     * })
     */
    private $wojewodztwo;



    /**
     * Set rspo.
     *
     * @param string|null $rspo
     *
     * @return School
     */
    public function setRspo($rspo = null)
    {
        $this->rspo = $rspo;

        return $this;
    }

    /**
     * Get rspo.
     *
     * @return string|null
     */
    public function getRspo()
    {
        return $this->rspo;
    }

    /**
     * Set powiat.
     *
     * @param int|null $powiat
     *
     * @return School
     */
    public function setPowiat($powiat = null)
    {
        $this->powiat = $powiat;

        return $this;
    }

    /**
     * Get powiat.
     *
     * @return int|null
     */
    public function getPowiat()
    {
        return $this->powiat;
    }

    /**
     * Set gmina.
     *
     * @param int|null $gmina
     *
     * @return School
     */
    public function setGmina($gmina = null)
    {
        $this->gmina = $gmina;

        return $this;
    }

    /**
     * Get gmina.
     *
     * @return int|null
     */
    public function getGmina()
    {
        return $this->gmina;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return School
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set type.
     *
     * @param string|null $type
     *
     * @return School
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return School
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address.
     *
     * @param string|null $address
     *
     * @return School
     */
    public function setAddress($address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipcode.
     *
     * @param string|null $zipcode
     *
     * @return School
     */
    public function setZipcode($zipcode = null)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode.
     *
     * @return string|null
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set post.
     *
     * @param string|null $post
     *
     * @return School
     */
    public function setPost($post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post.
     *
     * @return string|null
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set phone.
     *
     * @param string|null $phone
     *
     * @return School
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set www.
     *
     * @param string|null $www
     *
     * @return School
     */
    public function setWww($www = null)
    {
        $this->www = $www;

        return $this;
    }

    /**
     * Get www.
     *
     * @return string|null
     */
    public function getWww()
    {
        return $this->www;
    }

    /**
     * Set publicznosc.
     *
     * @param string|null $publicznosc
     *
     * @return School
     */
    public function setPublicznosc($publicznosc = null)
    {
        $this->publicznosc = $publicznosc;

        return $this;
    }

    /**
     * Get publicznosc.
     *
     * @return string|null
     */
    public function getPublicznosc()
    {
        return $this->publicznosc;
    }

    /**
     * Set studentCount.
     *
     * @param int|null $studentCount
     *
     * @return School
     */
    public function setStudentCount($studentCount = null)
    {
        $this->studentCount = $studentCount;

        return $this;
    }

    /**
     * Get studentCount.
     *
     * @return int|null
     */
    public function getStudentCount()
    {
        return $this->studentCount;
    }

    /**
     * Set classCount.
     *
     * @param int|null $classCount
     *
     * @return School
     */
    public function setClassCount($classCount = null)
    {
        $this->classCount = $classCount;

        return $this;
    }

    /**
     * Get classCount.
     *
     * @return int|null
     */
    public function getClassCount()
    {
        return $this->classCount;
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

    /**
     * Set wojewodztwo.
     *
     * @param \AppBundle\Entity\Wojewodztwo|null $wojewodztwo
     *
     * @return School
     */
    public function setWojewodztwo(\AppBundle\Entity\Wojewodztwo $wojewodztwo = null)
    {
        $this->wojewodztwo = $wojewodztwo;

        return $this;
    }

    /**
     * Get wojewodztwo.
     *
     * @return \AppBundle\Entity\Wojewodztwo|null
     */
    public function getWojewodztwo()
    {
        return $this->wojewodztwo;
    }
}
