<?php
namespace AppBundle\Service\Uploader;

use AppBundle\Service\Uploader\Exif;
use AppBundle\Service\Uploader\File;
use AppBundle\Service\Uploader\Upload;

class Uploader {

    private $max_size = 20; // maximum of 20mb
    private $allowed_type;
    private $files = array();
    private $des_dir;

    public function __construct()
    {
    }

    public function setMaxSize($size)
    {
        $this->max_size = $size;
    }

    public function setAllowedType(array $type)
    {
        $this->allowed_type = $type;
    }

    public function addFile($file)
    {
        $this->files[] = $file;
    }

    public function setDestinationDir($dir)
    {
        $this->des_dir = 'upload/'.$dir;
    }

    public function upload()
    {
        $validations = array(
            'category' => $this->allowed_type,
            'size' => $this->max_size
        );
        $upload = new Upload($this->files[0], $validations);

        foreach ($upload->files as $file) {
            if ($file->validate()) {
                // do your thing on this file ...
                // ...
                // say we don't allow audio files
                if ($file->is('audio')) $error = 'Audio not allowed';
                else {
                    // then get base64 encoded string to do something else ...
                    $filedata = $file->get_base64();

                    // or get the GPS info ...
                    $gps = $file->get_exif_gps();
                     $newFileName = substr(md5(microtime()),0,15);
                    // then we move it to 'path/to/my/uploads'
                    $result = $file->put($this->des_dir, $newFileName);
                    $error = $result ? '' : 'Error moving file';
                }

            } else {
                // oopps!
                $error = $file->get_error();
            }
            return $file->get_new_name();
        }
    }
}