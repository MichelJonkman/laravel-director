<?php

namespace MichelJonkman\Director;


use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Env;
use MichelJonkman\DbalSchema\Schema;
use MichelJonkman\Director\Exceptions\PublishException;
use MichelJonkman\Director\Menu\MenuManager;
use MichelJonkman\Director\Settings\SettingsManager;

class Director
{
    /** @var string The path that Vite builds to relative to the public folder */
    public const BUILD_DIRECTORY = 'director/director';
    public const BUILD_HOT_FILE  = 'director.hot';

    protected array $publicPublishes = [];

    protected Application $laravel;

    protected Filesystem $files;

    public function __construct(Application $laravel, Filesystem $files)
    {
        $this->laravel = $laravel;
        $this->files = $files;
    }

    /**
     * @throws PublishException
     */
    public function publicPublish(string $path, string $identifier): void
    {
        if (strlen($identifier) === 0) {
            throw new PublishException('Invalid identifier', PublishException::INVALID_IDENTIFIER_CODE);
        }

        if (!is_dir($path)) {
            throw new PublishException("Invalid directory path \"$path\"", PublishException::INVALID_DIRECTORY_PATH);
        }

        if (in_array($identifier, $this->publicPublishes)) {
            throw new PublishException("Duplicate identifier \"$identifier\"", PublishException::DUPLICATE_IDENTIFIER);
        }

        $this->publicPublishes[$path] = $identifier;
    }

    public function publicPublishPaths(): array
    {
        return $this->publicPublishes;
    }

    /**
     * Returns a MenuManager instance for easy access
     * @throws BindingResolutionException
     */
    public function menu(): MenuManager
    {
        return $this->laravel->make(MenuManager::class);
    }

    public function elementsAreCached(): bool
    {
        return $this->files->exists($this->getCachedElementsPath());
    }

    public function getCachedElementsPath(): string
    {
        return $this->normalizeCachePath('APP_MENU_CACHE', 'cache/elements.php');
    }

    /**
     * Returns a SettingsManager instance for easy access
     * @throws BindingResolutionException
     */
    public function settings(): SettingsManager
    {
        return $this->laravel->make(SettingsManager::class);
    }

    /**
     * Returns a Schema instance to add schema migration routes
     * @throws BindingResolutionException
     */
    public function schema(): Schema
    {
        return $this->laravel->make(Schema::class);
    }


    /**
     * Normalize a relative or absolute path to a cache file.
     */
    protected function normalizeCachePath(string $key, string $default): string
    {
        if (is_null($env = Env::get($key))) {
            return $this->laravel->bootstrapPath($default);
        }

        return $this->laravel->basePath($env);
    }

    public function getBuildHotFile()
    {
        return self::BUILD_HOT_FILE;
    }

    public function getBuildDirectory()
    {
        return self::BUILD_DIRECTORY;
    }
}
