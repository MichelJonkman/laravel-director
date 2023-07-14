<?php

namespace MichelJonkman\Director\Console;

use Illuminate\Filesystem\Filesystem;
use MichelJonkman\Director\Director;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'director:menu:clear')]
class MenuClearCommand extends DirectorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'director:menu:clear';

    /**
     * @var string
     */
    protected $description = 'Remove the menu cache file';

    protected Filesystem $files;

    public function __construct(Director $director, Filesystem $files)
    {
        parent::__construct($director);

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->files->delete($this->director->getCachedElementsPath());

        $this->components->info('Menu cache cleared successfully.');
    }
}
