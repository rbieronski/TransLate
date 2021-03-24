<?php


namespace Anguis\TransLate\Helper;


abstract class ArrayHelper
{

    /* TODO change method's name to better one... */
    public static function duplicateArrayByGivenParentKeys(array $keys, array $array): array
    {
        $resultArray = [];
        foreach ($keys as $key) {
            $resultArray[$key] = $array;
        }
        return $resultArray;
    }


    public static function ksort_recursive(array &$array)
    {
        ksort($array);
        foreach ($array as &$value) {
            if (is_array($value)) {
                self::ksort_recursive($value);
            }
        }
    }

    /**
     * https://www.php.net/manual/en/function.array-merge-recursive.php
     * @author gabriel.sobrinho@gmail.com
     */
    public static function array_merge_recursive_distinct(array &$array1, array &$array2): array
    {
        $merged = $array1;
        foreach ($array2 as $key => &$value) {
            if (
                is_array($value)
                && isset($merged[$key])
                && is_array($merged[$key])
            ) {
                $merged[$key] = self::array_merge_recursive_distinct(
                    array1: $merged [$key],
                    array2: $value
                );
            } else {
                $merged [$key] = $value;
            }
        }
        return $merged;
    }
}