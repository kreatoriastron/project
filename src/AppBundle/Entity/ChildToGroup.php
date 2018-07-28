<?php

namespace AppBundle\Entity;

/**
 * ChildToGroup
 */
class ChildToGroup
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Child
     */
    private $child;

    /**
     * @var \AppBundle\Entity\GroupList
     */
    private $grouplist;


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
     * Set child.
     *
     * @param \AppBundle\Entity\Child|null $child
     *
     * @return ChildToGroup
     */
    public function setChild(\AppBundle\Entity\Child $child = null)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * Get child.
     *
     * @return \AppBundle\Entity\Child|null
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * Set grouplist.
     *
     * @param \AppBundle\Entity\GroupList|null $grouplist
     *
     * @return ChildToGroup
     */
    public function setGrouplist(\AppBundle\Entity\GroupList $grouplist = null)
    {
        $this->grouplist = $grouplist;

        return $this;
    }

    /**
     * Get grouplist.
     *
     * @return \AppBundle\Entity\GroupList|null
     */
    public function getGrouplist()
    {
        return $this->grouplist;
    }
}
