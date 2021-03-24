<?php


namespace Anguis\TransLate\Reader;


interface TextFileReaderInterface
{

    public static function read(string $filepath): string;

    /**
     * Return associative array (read all files)
     * with filename as a key.
     */
    public static function readAll(array $filepaths): array;
}