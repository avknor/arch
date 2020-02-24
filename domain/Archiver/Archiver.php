<?php


namespace Domain\Archiver;


interface Archiver
{
    /**
     * Creates new archive file from FileList
     * @param FileList $files
     * @param string $output Fullname of output archive file
     * @return Archive
     */
    public function pack(FileList $files, string $output): Archive;

    /**
     * @param Archive $file
     * @param string $target_dir
     * @return bool Path to unpacked files
     */
    public function unpack(Archive $file, string $target_dir): bool;

    /**
     * Returns archive file extension
     * @return string
     */
    public function extension(): string;
}