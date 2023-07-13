<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\DbalSchema\Database\SchemaMigrator;
use MichelJonkman\DbalSchema\Schema;
use MichelJonkman\Director\Director;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        app(Director::class)->schema()->loadSchemaFrom(__DIR__.'/../../database/schema');
    }
}
