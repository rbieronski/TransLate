<?php


namespace Anguis\TransLate\Output;

use League\CLImate\CLImate;


class CLImateOutput implements OutputInterface
{

    protected CLImate $climate;


    public function __construct()
    {
        $this->climate = new CLImate();
    }

    public function show(string $data)
    {
        $formatted = str_replace(
            search: '""',
            replace: '<white><background_red>""</background_red></white>',
            subject: $data
        );
        $this->climate->out($formatted);
    }
}