<?php

namespace Tests\Traits;

use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Foundation\Testing\RefreshDatabase as FrameworkRefreshDatabase;

trait RefreshDatabase
{

    use FrameworkRefreshDatabase {
        refreshTestDatabase as frameworkRefreshTestDatabase;
    }

    /**
     * Refresh a conventional test database.
     *
     * This is a drop-in replacement for Laravel's `RefreshDatabase` testing trait. Do not use them together.
     *
     * We are having migrations targeting two different database connections. The default one "mysql" and another one
     * named "addresses". The `migrate:fresh` command used in the original trait, only drops the tables the default
     * connection. The `--database` option has no use here as it will cause all migrations run against that connection.
     *
     * To workaround the issue, this method calls drops the tables in additionally specified connections which should be
     * stored in test class's `$connectionsToReset` property. Just as Laravel's `$connectionsToTransact` works.
     *
     * More information:
     * https://github.com/laravel/framework/issues/21063
     *
     * @return void
     */

    protected function refreshTestDatabase()
    {
        if (! RefreshDatabaseState::$migrated) {
            $database = $this->app->make('db');

            foreach ($this->connectionsToReset() as $connection) {
                $database
                    ->connection($connection)
                    ->getSchemaBuilder()
                    ->dropAllTables();
            }
        }

        $this->frameworkRefreshTestDatabase();
    }

    /**
     * The database connections that should be reset before running `migrate:fresh` command.
     *
     * @return array
     */

    protected function connectionsToReset(): array
    {
        return $this->connectionsToReset ?? [];
    }

}