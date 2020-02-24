<?php


namespace Domain\Archiver\Exception;


use Exception;
use Throwable;

class WrongFileListItemType extends Exception
{

    //todo: create "given type" functionality
    protected $message = 'FileList item must be a string or File object.';

}