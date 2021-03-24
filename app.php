<?php

require_once __DIR__ . '/vendor/autoload.php';

use Anguis\TransLate\Output\OutputRouter;
use Anguis\TransLate\Reader\DefaultJsonFileReader;
use Anguis\TransLate\Reader\PlainTextFileReader;
use Anguis\TransLate\Searcher\FileSearcher;
use Anguis\TransLate\Searcher\Filter\FilenameFilter;
use Anguis\TransLate\Extractor\RegexpExtractor;
use Anguis\TransLate\Converter\DottedStringToArrayConverter;
use Anguis\TransLate\Helper\ArrayHelper;

/**
 * TransLate
 *
 * Script detecting missing translations.
 *
 * It scans given directory to find .html files, extracts translation phrases
 * from that files, compares result with given translation file
 * and prints result output to CLI.
 *
 * Available flag '-pretty' to highlight missing translations
 * using 3rd party package CLImate:
 *  > php app.php -pretty
 *
 * @author Rafał Bieroński <bluenow@gmail.com>
 */


/**
 * Define paths.
 */
$translationFilePath = 'Translations/locales/locales.json';
$directoryToScanForFiles = 'Translations/';


/**
 * Scan entire given directory to find files.
 */
$fileSearcher = new FileSearcher(
    paths: [$directoryToScanForFiles],
    filterInterface: new FilenameFilter(pattern: '*.html', caseSensitive: true)
);
$htmlFilesCollection = $fileSearcher->search();


/**
 * Extract specified phrases from given strings.
 * Returns array: [file_index][match_index] => matchValue
 */
$extractor = new RegexpExtractor();
$allFilesMatches = $extractor->extract(
    PlainTextFileReader::readAll($htmlFilesCollection)
);


/**
 * String-To-Array conversion all matches (phrases) from all files.
 */
$phrases = [];
$converter = new DottedStringToArrayConverter(defaultValue: '', separator: '.');

foreach ($allFilesMatches as $fileMatches) {
    foreach ($fileMatches as $match) {
        $phrases = array_merge_recursive($phrases, $converter->convert($match));
    }
}


/**
 * Sort array and merge with translations array (right join).
 */
$translations = DefaultJsonFileReader::read($translationFilePath);
$languages = array_keys($translations);

ArrayHelper::ksort_recursive($phrases);
$result = ArrayHelper::duplicateArrayByGivenParentKeys($languages, $phrases);
$result = ArrayHelper::array_merge_recursive_distinct($result,$translations);


/**
 * Show the result.
 */
$output = OutputRouter::detectOutput($argv)->show(
    json_encode($result,JSON_PRETTY_PRINT)
);















