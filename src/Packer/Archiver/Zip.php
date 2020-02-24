<?php


namespace App\Packer\Archiver;


use Domain\Archiver\Archive;
use Domain\Archiver\Archiver;
use Domain\Archiver\FileList;
use Exception;
use ZipArchive;

class Zip implements Archiver
{
    /**
     * @param FileList $file_list
     * @param string $output
     * @return Archive
     * @throws Exception
     */
    public function pack(FileList $file_list, string $output): Archive
    {
        $zip = new ZipArchive();
        if ($zip->open($output, ZIPARCHIVE::CREATE) != TRUE) {
            die ("Could not open archive");
        }
        foreach ($file_list as $file) {
            $zip->addFile($file, $file->originalBasename());
        }

        $zip->close();


        return new Archive($output);
    }

    /**
     * @param Archive $file
     * @param string $target_dir
     * @return bool
     */
    public function unpack(Archive $file, string $target_dir): bool
    {
        $zip = new ZipArchive();
        if ($zip->open($file->basename()) === true){
            $zip->extractTo($target_dir);
            $zip->close();

            return true;
        }

        return false;
    }

    public function extension(): string
    {

        return 'zip';
    }
}