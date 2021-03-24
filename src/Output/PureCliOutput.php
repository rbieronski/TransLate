<?php


namespace Anguis\TransLate\Output;


class PureCliOutput implements OutputInterface
{

    public function show(string $data)
    {
        echo $data . "\n";
    }
}