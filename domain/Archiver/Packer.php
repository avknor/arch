<?php


namespace Domain\Archiver;


use Domain\Archiver\Service\FileNamingService;
use Exception;

abstract class Packer
{
    abstract public function getArchiver(): Archiver;

    /**
     * @param FileList $file_list
     * @param string $target_dir
     * @return Archive
     * @throws Exception
     */
    public function pack(FileList $file_list, string $target_dir): Archive
    {
        //todo: validate target_dir
        $archiver = $this->getArchiver();
        $archive_name = FileNamingService::generateArchiveName($target_dir, $archiver->extension());
        $archive = $archiver->pack($file_list, $archive_name);

        if (!$archive) {
            throw new Exception('Archive didn\'t created.' );
        }

        $file_list->clear();

        return $archive;
    }

    public function unpack(Archive $file, string $target_dir)
    {
        $archiver = $this->getArchiver();
        $archiver->unpack($file, $target_dir);
    }
}