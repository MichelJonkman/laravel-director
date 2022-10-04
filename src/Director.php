<?php

namespace MichelJonkman\Director;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Env;
use MichelJonkman\Director\Exceptions\PublishException;
use MichelJonkman\Director\Menu\MenuManager;

class Director
{
    /** @var string The path that Vite builds to relative to the public folder */
    public const BUILD_DIRECTORY = 'director/director';

    protected array $publicPublishes = [];

    protected Application $laravel;

    public function __construct(Application $laravel)
    {
        $this->laravel = $laravel;
    }

    /**
     * @throws PublishException
     */
    public function publicPublish(string $path, string $identifier): void
    {
        if (strlen($identifier) === 0) {
            throw new PublishException('Invalid identifier', PublishException::INVALID_IDENTIFIER_CODE);
        }

        $this->publicPublishes[$path] = $identifier;
    }

    public function publicPublishPaths(): array
    {
        return $this->publicPublishes;
    }

    /**
     * Returns a MenuManager instance for easy access
     */
    public function menu(): MenuManager
    {
        return app(MenuManager::class);
    }

    public function getCachedMenuPath(): string
    {
        return $this->normalizeCachePath('APP_MENU_CACHE', 'cache/menu.php');
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
}
