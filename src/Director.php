<?php

namespace MichelJonkman\Director;


/**
 *
 */
class Director
{
    protected array $publicVendor = [];

    public function publicVendor(string $path, string $identifier) {
        $this->publicVendor[$path] = $identifier;
    }

    public function publicVendorPaths() {
        return $this->publicVendor;
    }
}