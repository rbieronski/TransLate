<?php

namespace Anguis\TransLate\Searcher;


use Anguis\TransLate\Searcher\Filter\FilterInterface;

/**
 * Class DirectoryStructureSearch
 * @package Anguis\TransLate\Search
 *
 * Class reproduces all directory structure (tree)
 * and results in array form using search method.
 *
 * Every given path should end with path separator
 * e.g. MyFolder/ instead just MyFolder
 */
class FileSearcher implements SearcherInterface
{

    protected array $paths;
    protected FilterInterface|null $filterInterface;


    public function __construct(
        array $paths,
        FilterInterface|null $filterInterface
    ) {
        $this->paths = $paths;
        $this->filterInterface = $filterInterface;
    }

    public function search(): array
    {
        /* build directories structure tree */
        $tree = [];
        foreach ($this->paths as $path) {
            //print_r($path);
            $this->buildTree(path: $path,target: $tree);
        }
        /* filter results */
        if (!is_null($this->filterInterface)) {
            $tree = $this->filterInterface->filter($tree);
        }
        return $tree;
    }

    protected function buildTree(string $path, array &$target)
    {
        foreach (scandir($path) as $object) {

            $objectFullPath = $path . $object;
            /* skip Unix file system nodes */
            if ($object === '.' or $object === '..') continue;
            if (is_dir($objectFullPath)) {
                $this->buildTree(
                    path: $objectFullPath . DIRECTORY_SEPARATOR,
                    target: $target
                );
            } else { // adding found file to array
                $target[] = $objectFullPath;
            }
        }
    }
}