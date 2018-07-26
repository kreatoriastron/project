<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserParent
 *
 * @ORM\Table(name="user_parent", indexes={@ORM\Index(name="parent_user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class UserParent
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="contract_file", type="string", length=30, nullable=true)
     */
    private $contractFile;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AppUsers
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AppUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Set contractFile.
     *
     * @param string|null $contractFile
     *
     * @return UserParent
     */
    public function setContractFile($contractFile = null)
    {
        $this->contractFile = $contractFile;

        return $this;
    }

    /**
     * Get contractFile.
     *
     * @return string|null
     */
    public function getContractFile()
    {
        return $this->contractFile;
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
     * Set user.
     *
     * @param \AppBundle\Entity\AppUsers|null $user
     *
     * @return UserParent
     */
    public function setUser(\AppBundle\Entity\AppUsers $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\AppUsers|null
     */
    public function getUser()
    {
        return $this->user;
    }
}
