<?php


namespace App\Service;


use Domain\Archiver\File;
use Domain\Archiver\FileList;
use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private string $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = rtrim($targetDirectory, '/') . '/';
    }

    /**
     * @param UploadedFile ...$files
     * @return FileList
     * @throws Exception
     */
    public function upload(UploadedFile ...$files): FileList
    {
        $file_list = new FileList();

        if ($files) {
            foreach ($files as $file) {
                $filename = $this->uploadFile($file);

                $file_list->add($filename);
            }
        }

        return $file_list;
    }

    /**
     * @param UploadedFile $uploaded_file
     * @return File
     * @throws Exception
     */
    private function uploadFile(UploadedFile $uploaded_file): File
    {
        $originalFilename = $uploaded_file->getClientOriginalName();
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $safeFilename .= '-'.uniqid().'.'.$uploaded_file->getClientOriginalExtension();

        try {
            $uploaded_file->move($this->getTargetDirectory(), $safeFilename);
        } catch (FileException $e) {
            throw new Exception('File didn\'t upload');
        }

        $file = new File($this->getTargetDirectory() . '/' . $safeFilename);
        $file->setOriginalName($originalFilename);

        return $file;
    }

    private function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}