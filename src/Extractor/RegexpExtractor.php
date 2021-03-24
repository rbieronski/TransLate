<?php


namespace Anguis\TransLate\Extractor;


use Anguis\TransLate\Reader\TextFileReaderInterface;


class RegexpExtractor implements ExtractorInterface
{
    /**
     * Used regular expression to get matches:
     *      start:   {{ $t('
     *      match:   all between
     *      end:     ') }}
     */
    public const REGEXP_PATTERN = '/(({{ \$t\(\')(.+?)(\'\) }}))/';
    public const REGEXP_MATCH_GROUP = 3;


    public function extract(array $strings): array
    {
        $result = [];
        foreach($strings as $string) {
            $matches = [];
            preg_match_all(
                pattern: self::REGEXP_PATTERN,
                subject: $string,
                matches: $matches
            );
            // TODO $matches[3] why and give to construct? ???
            $result[] = $matches[self::REGEXP_MATCH_GROUP];
        }
        return $result;
    }
}