<?php


namespace App\Packer\Archiver;


use Archive_Tar;
use Domain\Archiver\Archive;
use Domain\Archiver\Archiver;
use Domain\Archiver\FileList;
use Exception;


class Tar implements Archiver
{
    /**
     * @param FileList $file_list
     * @param string $output
     * @return Archive
     * @throws Exception
     */
    public function pack(FileList $file_list, string $output): Archive
    {
        $tar = new Archive_Tar($output);

        $files = [];
        foreach ($file_list as $file) {
            $files[] = $file;
        }
        $tar->createModify($files, '', pathinfo($files[0], PATHINFO_DIRNAME));

        return new Archive($output);
    }

    /**
     * @param Archive $file
     * @param string $target_dir
     * @return bool
     */
    public function unpack(Archive $file, string $target_dir): bool
    {
        $tar = new Archive_Tar($file);
        return $tar->extract($target_dir);
    }

    public function extension(): string
    {

        return 'tar';
    }
}