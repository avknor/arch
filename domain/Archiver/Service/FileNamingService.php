<?php


namespace Domain\Archiver\Service;


use Exception;

class FileNamingService
{

    /**
     * @param string $target_path
     * @param string $extension
     * @return string
     * @throws Exception
     */
    public static function generateArchiveName(string $target_path, string $extension): string
    {

        return self::provePath($target_path).uniqid().'.'.$extension;
    }

    /**
     * @param string $path
     * @return string
     * @throws Exception
     */
    public static function provePath(string $path): string
    {
        $path = rtrim($path, '/').'/';

        if (!is_writable($path)) {
            throw new Exception('Download directory is not writable.');
        }

        return $path;
    }
}