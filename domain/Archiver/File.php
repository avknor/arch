<?php


namespace Domain\Archiver;


use Exception;

class File extends AbstractFile
{
    private string $original_name;

    public function setOriginalName(string $original_name): void
    {
        $this->original_name = $original_name;
    }

    public function originalBasename(): ?string
    {

        return "{$this->original_name}.{$this->file_info->getExtension()}";
    }
}