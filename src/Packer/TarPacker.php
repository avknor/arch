<?php


namespace App\Packer;


use App\Packer\Archiver\Tar;
use Domain\Archiver\Archiver;
use Domain\Archiver\Packer;

class TarPacker extends Packer
{

    public function getArchiver(): Archiver
    {

        return new Tar();
    }
}