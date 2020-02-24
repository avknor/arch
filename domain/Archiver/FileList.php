<?php


namespace Domain\Archiver;


use ArrayIterator;
use Domain\Archiver\Exception\WrongFileListItemType;
use Exception;
use IteratorAggregate;
use Traversable;

class FileList implements IteratorAggregate
{
    private array $files = [];

    /**
     * FileList constructor.
     * @param File ...$files
     */
    public function __construct(File ...$files)
    {
        foreach ($files as $file) {
            $this->add($file);
        }
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->files);
    }

    public function add(File $file): void
    {
        $this->files[] = $file;
    }

    public function isEmpty(): bool
    {
        return empty($this->files);
    }

    /**
     * Deletes all files from the list
     */
    public function clear(): void
    {
        foreach ($this as $file) {
            unlink ((string) $file);
        }
    }
}