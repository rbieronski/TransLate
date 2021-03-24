<?php


namespace Anguis\TransLate\Output;


abstract class OutputRouter
{

    public static function detectOutput(array $arguments): OutputInterface
    {
        if ((isset($arguments[1]) ? $arguments[1] : null) === '-pretty') {
            return new CLImateOutput();
        } else {
            return new PureCliOutput();
        }
    }
}