<?php


namespace Anguis\TransLate\Reader;


interface JsonFileReaderInterface
{

    public static function read($jsonPath): array;
}