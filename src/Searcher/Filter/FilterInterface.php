<?php


namespace Anguis\TransLate\Searcher\Filter;


interface FilterInterface
{

    public function filter(array $given): array;
}