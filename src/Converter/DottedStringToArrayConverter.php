<?php


namespace Anguis\TransLate\Converter;


/**
 * Converter class converts dotted-separated strings like
 * into associative array. Sample:
 *
 *      method:         convert('foo.bar.test')
 *      results in:     [foo][bar][test] => ''
 */
class DottedStringToArrayConverter implements StringToArrayConverterInterface
{

    protected string $separator;
    protected string $defaultValue;


    public function __construct(string $defaultValue, string $separator)
    {
        $this->separator = $separator;
        $this->defaultValue = $defaultValue;
    }

    public function convert(string $stringToConvert): array
    {
        $result = [];
        $this->arraySet(
            array: $result,
            string: $stringToConvert,
            value: $this->defaultValue,
            separator: $this->separator
        );
        return $result;
    }

    function arraySet(
        array &$array,
        string $string,
        string $value,
        string $separator
    ) {
        $keys = explode($separator, $string);
        $current = &$array;
        foreach ($keys as $key) {
            $current = &$current[$key];
        }
        $current = $value;
    }
}