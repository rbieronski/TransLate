<?php


namespace Anguis\TransLate\Reader;


class PlainTextFileReader implements TextFileReaderInterface
{

    public static function read(string $filepath): string
    {
        return file_get_contents($filepath);
    }

    public static function readAll(array $filepaths): array
    {
        $stringsArray = [];
        foreach ($filepaths as $filepath) {
            $stringsArray[$filepath] = self::read($filepath);
        }
        return $stringsArray;
    }
}