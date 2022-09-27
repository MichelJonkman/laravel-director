<?php

namespace MichelJonkman\Director\Base\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\Local\LocalFilesystemAdapter as LocalAdapter;
use League\Flysystem\MountManager;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use League\Flysystem\Visibility;
use MichelJonkman\Director\Base\Director;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'director:public')]
class PublicCommand extends Command
{
    protected $signature = 'director:public {--copy : Use copies instead of symlink}';

    protected $description = 'Publish Director Vite packages to public';

    public function __construct(protected Filesystem $files, protected Director $director)
    {
        parent::__construct();
    }

    /**
     * @throws FilesystemException
     */
    public function handle()
    {
        $publishPaths = $this->director->publicPublishPaths();

        if (count($publishPaths) == 0) {
            $this->components->info('No publishable resources for Director.');

            return;
        }

        if ($this->files->exists(public_path('director'))) {
            $this->components->info('Deleting "director" folder in public.');
            $this->files->deleteDirectory(public_path('director'));
        }

        $this->files->makeDirectory(public_path('director'));

        if ($this->option('copy')) {
            $this->copyPublishes($publishPaths);
        } else {
            $this->linkPublishes($publishPaths);
        }

        $this->newLine();
    }

    /**
     * Symlinks the published folders
     *
     * @param array $publishPaths
     * @return void
     */
    protected function linkPublishes(array $publishPaths): void
    {
        $this->components->info('Linking public Director assets.');

        $cwd = getcwd();

        $publicPath = public_path("director");
        chdir($publicPath);

        foreach ($publishPaths as $path => $identifier) {
            $sourcePath = absoluteToRelativePath($publicPath, realpath($path));
            $targetPath = public_path("director/$identifier");

            symlink($sourcePath, $targetPath);
        }

        chdir($cwd);

        $this->components->info('Linked all published Director assets.');
    }

    /**
     * Copies the published folders
     *
     * @param array $publishPaths
     * @return void
     * @throws FilesystemException
     */
    protected function copyPublishes(array $publishPaths): void
    {
        $this->components->info('Copying public Director assets.');

        foreach ($publishPaths as $path => $identifier) {
            $this->publishItem($path, public_path("director/$identifier"));
        }
    }

    /**
     * @throws FilesystemException
     */
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
     * @param string $from
     * @param string $to
     *
     * @return void
     */
    protected function publishFile(string $from, string $to): void
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
     * @param string $directory
     *
     * @return void
     */
    protected function createParentDirectory(string $directory): void
    {
        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }

    /**
     * Write a status message to the console.
     *
     * @param string $from
     * @param string $to
     * @param string $type
     *
     * @return void
     */
    protected function status(string $from, string $to, string $type): void
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
