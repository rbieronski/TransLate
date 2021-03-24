<?php


namespace Anguis\TransLate\Extractor;


interface ExtractorInterface
{

    public function extract(array $strings): array;
}