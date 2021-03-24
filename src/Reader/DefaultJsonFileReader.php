<?php


namespace Anguis\TransLate\Reader;


/**
 * Json reader class just in a case
 */
class DefaultJsonFileReader implements JsonFileReaderInterface
{

    public static function read($jsonPath): array
    {
        return json_decode(
            json: file_get_contents($jsonPath),
            associative: true
        );
    }
}