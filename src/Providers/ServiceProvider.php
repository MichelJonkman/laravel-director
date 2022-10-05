<?php

namespace MichelJonkman\Director\Providers;


use Closure;

abstract class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected static array $registeredCallbacks = [];
    protected static array $registeredProviders = [];

    protected static function registered(Closure $callback)
    {
        if (self::isRegistered()) {
            $callback();

            return;
        }

        if (!isset(self::$registeredCallbacks[static::class])) {
            self::$registeredCallbacks[static::class] = [];
        }

        self::$registeredCallbacks[static::class][] = $callback;
    }

    protected static function getRegisteredCallbacks(string $provider)
    {
        return self::$registeredCallbacks[$provider] ?? [];
    }

    public function callRegisteredCallbacks()
    {
        foreach (self::getRegisteredCallbacks(static::class) as $callback) {
            $this->app->call($callback);
        }
    }

    public function register()
    {
        $this->registerService();
        $this->endRegister();
    }

    /**
     * Use this to register the service provider instead of register()
     */
    protected function registerService()
    {
    }

    protected function endRegister()
    {
        $this->callRegisteredCallbacks();
        $this->markAsRegistered();
    }

    protected static function markAsRegistered()
    {
        self::$registeredProviders[] = static::class;
    }

    protected static function isRegistered(): bool
    {
        return in_array(static::class, self::$registeredProviders);
    }
}