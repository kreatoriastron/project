<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImportFile
 *
 * @ORM\Table(name="import_file")
 * @ORM\Entity
 */
class ImportFile
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="dir", type="string", length=30, nullable=true)
     */
    private $dir;

    /**
     * @var string|null
     *
     * @ORM\Column(name="filename", type="string", length=30, nullable=true)
     */
    private $filename;

    /**
     * @var int|null
     *
     * @ORM\Column(name="in_progress", type="integer", nullable=true)
     */
    private $inProgress = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="imported", type="integer", nullable=true)
     */
    private $imported = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="type", type="integer", nullable=true, options={"comment"="1- import szkół"})
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="error", type="string", length=50, nullable=true)
     */
    private $error;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set dir.
     *
     * @param string|null $dir
     *
     * @return ImportFile
     */
    public function setDir($dir = null)
    {
        $this->dir = $dir;

        return $this;
    }

    /**
     * Get dir.
     *
     * @return string|null
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Set filename.
     *
     * @param string|null $filename
     *
     * @return ImportFile
     */
    public function setFilename($filename = null)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename.
     *
     * @return string|null
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set inProgress.
     *
     * @param int|null $inProgress
     *
     * @return ImportFile
     */
    public function setInProgress($inProgress = null)
    {
        $this->inProgress = $inProgress;

        return $this;
    }

    /**
     * Get inProgress.
     *
     * @return int|null
     */
    public function getInProgress()
    {
        return $this->inProgress;
    }

    /**
     * Set imported.
     *
     * @param int|null $imported
     *
     * @return ImportFile
     */
    public function setImported($imported = null)
    {
        $this->imported = $imported;

        return $this;
    }

    /**
     * Get imported.
     *
     * @return int|null
     */
    public function getImported()
    {
        return $this->imported;
    }

    /**
     * Set type.
     *
     * @param int|null $type
     *
     * @return ImportFile
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
     * Set error.
     *
     * @param string|null $error
     *
     * @return ImportFile
     */
    public function setError($error = null)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Get error.
     *
     * @return string|null
     */
    public function getError()
    {
        return $this->error;
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
