<?php

namespace MichelJonkman\Director\Console;


use Illuminate\Console\Command;
use MichelJonkman\Director\Director;


abstract class DirectorCommand extends Command
{
    protected Director $director;

    public function __construct(Director $director)
    {
        parent::__construct();

        $this->director = $director;
    }
}