<?php

namespace AppBundle\Entity;

/**
 * ImportFile
 */
class ImportFile
{
    /**
     * @var string|null
     */
    private $dir;

    /**
     * @var string|null
     */
    private $filename;

    /**
     * @var int|null
     */
    private $inProgress = '0';

    /**
     * @var int|null
     */
    private $imported = '0';

    /**
     * @var int|null
     */
    private $type;

    /**
     * @var string|null
     */
    private $error;

    /**
     * @var int
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
