<?php

namespace App\Classes;

use App\Entity\Picture;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Naming\SubdirDirectoryNamer;

class MyDirectoryNamer extends SubdirDirectoryNamer implements DirectoryNamerInterface
{

    /**
     * Creates a directory name for the file being uploaded.
     *
     * @param Picture $object The object the upload is attached to
     * @param \Vich\UploaderBundle\Mapping\PropertyMapping $mapping The mapping to use to manipulate the given object
     *
     * @return string The directory name
     */
    public function directoryName($object, \Vich\UploaderBundle\Mapping\PropertyMapping $mapping): string
    {
        return $object->getOwner()->getId();
    }
}