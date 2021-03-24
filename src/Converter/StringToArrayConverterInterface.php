<?php


namespace Anguis\TransLate\Converter;


interface StringToArrayConverterInterface
{

    public function convert(string $stringToConvert): array;
}