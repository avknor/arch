<?php


namespace App\Service;


use Domain\Archiver\Packer;
use Exception;

class PackerService
{
    public static function concretePacker(string $extension): Packer
    {
        $concrete_packer = 'App\Packer\\' . ucfirst(strtolower($extension)).'Packer';

        if (!class_exists($concrete_packer)) {
            throw new Exception('No such packer.');
        }

        return new $concrete_packer();
    }
}