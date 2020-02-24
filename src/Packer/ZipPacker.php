<?php


namespace App\Packer;


use App\Packer\Archiver\Zip;
use Domain\Archiver\Archiver;
use Domain\Archiver\Packer;

class ZipPacker extends Packer
{

    public function getArchiver(): Archiver
    {

        return new Zip();
    }
}