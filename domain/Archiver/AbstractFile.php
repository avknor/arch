<?php


namespace Domain\Archiver;


use Exception;
use SplFileInfo;

class AbstractFile
{
    protected SplFileInfo $file_info;

    /**
     * AbstractFile constructor.
     * @param string $filename
     * @throws Exception
     */
    public function __construct(string $filename)
    {
        if (!file_exists($filename)) {
            throw new Exception("File {$filename} doesn't exists");
        }

        $this->file_info = new SplFileInfo($filename);
    }

    public function __toString()
    {

        return $this->info()->getRealPath();
    }

    public function basename(): string
    {

        return $this->info()->getBasename();
    }

    public function info()
    {

        return $this->file_info;
    }
}