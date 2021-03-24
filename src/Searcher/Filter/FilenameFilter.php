<?php


namespace Anguis\TransLate\Searcher\Filter;


class FilenameFilter implements FilterInterface
{

    protected string $pattern;
    protected bool $caseSensitive;


    public function __construct(string $pattern, bool $caseSensitive)
    {
        $this->caseSensitive = $caseSensitive;
        if (!$caseSensitive) {
            $this->pattern = $pattern;
        } else {
            $this->pattern = strtolower($pattern);
        }
    }

    public function filter(array $given): array
    {
        $filtered = [];
        foreach ($given as $item) {
            if ($this->isConditionMet($item)) {
                $filtered[] = $item;
            }
        }
        return $filtered;
    }

    protected function isConditionMet(string $item): bool
    {
        if ($this->caseSensitive) {
            $item = strtolower($item);
        }
        return fnmatch($this->pattern, $item);
    }
}