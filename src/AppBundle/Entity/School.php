<?php

namespace AppBundle\Entity;

/**
 * School
 */
class School
{
    /**
     * @var string|null
     */
    private $rspo;

    /**
     * @var int|null
     */
    private $powiat;

    /**
     * @var int|null
     */
    private $gmina;

    /**
     * @var string|null
     */
    private $city;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $nameOwn = '-';

    /**
     * @var string|null
     */
    private $address;

    /**
     * @var string|null
     */
    private $zipcode;

    /**
     * @var string|null
     */
    private $post;

    /**
     * @var string|null
     */
    private $phone;

    /**
     * @var string|null
     */
    private $www;

    /**
     * @var string|null
     */
    private $publicznosc;

    /**
     * @var int|null
     */
    private $studentCount;

    /**
     * @var int|null
     */
    private $classCount;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\SchoolToDr
     */
    private $std;

    /**
     * @var \AppBundle\Entity\Wojewodztwo
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
     * Set nameOwn.
     *
     * @param string|null $nameOwn
     *
     * @return School
     */
    public function setNameOwn($nameOwn = null)
    {
        $this->nameOwn = $nameOwn;

        return $this;
    }

    /**
     * Get nameOwn.
     *
     * @return string|null
     */
    public function getNameOwn()
    {
        return $this->nameOwn;
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
     * Set std.
     *
     * @param \AppBundle\Entity\SchoolToDr|null $std
     *
     * @return School
     */
    public function setStd(\AppBundle\Entity\SchoolToDr $std = null)
    {
        $this->std = $std;

        return $this;
    }

    /**
     * Get std.
     *
     * @return \AppBundle\Entity\SchoolToDr|null
     */
    public function getStd()
    {
        return $this->std;
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
