<?php

namespace MichelJonkman\Director\Base;


use MichelJonkman\Director\Base\Exceptions\PublishException;

/**
 *
 */
class Director
{
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
}
