<?php

namespace Janyk\LaravelMoneybirdSync;

use Janyk\LaravelMoneybirdSync\Commands\PushContactCommand;
use Picqer\Financials\Moneybird\Connection;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MoneybirdSyncServiceProvider extends PackageServiceProvider
{
    public function bootingPackage(): void
    {
        $this->registerConnectionSingleton();
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('moneybird-sync')
            ->hasConfigFile()
            ->hasCommand(PushContactCommand::class);
    }

    protected function registerConnectionSingleton(): void
    {
        $this->app->singleton(Connection::class, function ($app) {
            $config = $app['config']['moneybird-sync'];

            $connection = new Connection();
            $connection->setAdministrationId($config['administration_id']);
            $connection->setClientId($config['client_id']);
            $connection->setClientSecret($config['client_secret']);
            $connection->setAccessToken($config['token']);

            return $connection;
        });
    }
}
