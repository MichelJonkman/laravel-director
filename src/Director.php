<?php

namespace MichelJonkman\Director;


use MichelJonkman\Director\Exceptions\PublishException;
use MichelJonkman\Director\Menu\MenuManager;

class Director
{
    /** @var string The path that Vite builds to relative to the public folder */
    public const BUILD_DIRECTORY = 'director/director';

    protected array $publicPublishes = [];

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
    public function menu(): MenuManager {
        return app(MenuManager::class);
    }
}
