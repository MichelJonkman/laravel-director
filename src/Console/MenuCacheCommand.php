<?php

namespace MichelJonkman\Director\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\RouteCollection;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Exceptions\Menu\ElementValidationException;
use MichelJonkman\Director\Exceptions\Menu\MissingModificationException;
use MichelJonkman\Director\Menu\Elements\Element;
use MichelJonkman\Director\Menu\Elements\RootElementInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'director:menu:cache')]
class MenuCacheCommand extends DirectorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'director:menu:cache';

    /**
     * The name of the console command.
     *
     * This name is used to identify the command during lazy loading.
     *
     * @var string|null
     *
     * @deprecated
     */
    protected static $defaultName = 'director:menu:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a menu cache file for faster menu registration, only use if your application has a lot of menu modifications';

    protected Filesystem $files;

    public function __construct(Director $director, Filesystem $files)
    {
        parent::__construct($director);

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @throws MissingModificationException
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $this->callSilent('director:menu:clear');

        $root = $this->getRoot();

        $this->files->put(
            $this->director->getCachedMenuPath(),
            $this->buildMenuCacheFile($root)
        );

        $this->components->info('Menu cached successfully.');
    }

    /**
     * @throws MissingModificationException
     */
    public function getRoot(): RootElementInterface
    {
        return $this->director->menu()->getRoot();
    }

    /**
     * @throws FileNotFoundException
     * @throws ElementValidationException
     */
    protected function buildMenuCacheFile(RootElementInterface $root): string
    {
        $stub = $this->files->get(__DIR__.'/stubs/menu.stub');

        return str_replace('{{root}}', var_export($root->toArray(), true), $stub);
    }
}
