<?php

namespace MichelJonkman\Director\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\Local\LocalFilesystemAdapter as LocalAdapter;
use League\Flysystem\MountManager;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use League\Flysystem\Visibility;
use MichelJonkman\Director\Director;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'director:public')]
class PublicCommand extends Command
{
    protected $signature = 'director:public';

    protected $description = 'Publish Director Vite packages to public';

    public function __construct(protected Filesystem $files, protected Director $director)
    {
        parent::__construct();
    }

    public function handle()
    {
        $publicVendorPaths = $this->director->publicVendorPaths();

        if (count($publicVendorPaths) == 0) {
            $this->components->info('No publishable resources for Director.');

            return;
        }

        $this->components->info('Publishing public Director assets.');

        if ($this->files->exists(public_path('director'))) {
            $this->components->info('Deleting "director" folder in public.');
            $this->files->deleteDirectory(public_path('director'));
        }

        foreach ($publicVendorPaths as $path => $identifier) {
            $this->publishItem($path, public_path("director/$identifier"));
        }

        $this->newLine();
    }

    protected function publishItem(string $from, string $to)
    {
        if ($this->files->isFile($from)) {
            $this->publishFile($from, $to);

            return;
        } elseif ($this->files->isDirectory($from)) {
            $this->publishDirectory($from, $to);

            return;
        }

        $this->components->error("Can't locate path: <{$from}>");
    }

    /**
     * Publish the file to the given path.
     *
     * @param  string  $from
     * @param  string  $to
     *
     * @return void
     */
    protected function publishFile($from, $to)
    {
        $this->createParentDirectory(dirname($to));

        $this->files->copy($from, $to);

        $this->status($from, $to, 'file');
    }

    /**
     * @throws FilesystemException
     */
    protected function publishDirectory(string $from, string $to): void
    {
        $visibility = PortableVisibilityConverter::fromArray([], Visibility::PUBLIC);

        $this->moveManagedFiles(new MountManager([
            'from' => new Flysystem(new LocalAdapter($from)),
            'to' => new Flysystem(new LocalAdapter($to, $visibility)),
        ]));

        $this->status($from, $to, 'directory');
    }

    /**
     * @throws FilesystemException
     */
    protected function moveManagedFiles(MountManager $manager): void
    {
        foreach ($manager->listContents('from://', true) as $file) {
            $path = Str::after($file['path'], 'from://');

            if (
                $file['type'] === 'file'
            ) {
                $manager->write('to://'.$path, $manager->read($file['path']));
            }
        }
    }

    /**
     * Create the directory to house the published files if needed.
     *
     * @param  string  $directory
     *
     * @return void
     */
    protected function createParentDirectory($directory)
    {
        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }

    /**
     * Write a status message to the console.
     *
     * @param  string  $from
     * @param  string  $to
     * @param  string  $type
     *
     * @return void
     */
    protected function status($from, $to, $type)
    {
        $from = str_replace(base_path().'/', '', realpath($from));

        $to = str_replace(base_path().'/', '', realpath($to));

        $this->components->task(sprintf(
            'Copying %s [%s] to [%s]',
            $type,
            $from,
            $to,
        ));
    }
}
