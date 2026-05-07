<?php

namespace AbdurRahaman\Icon\Console;

use Illuminate\Console\Command;

class IconInstallCommand extends Command
{
    protected $signature = 'icon:install';
    protected $description = 'Install Icon package (publish assets, routes, run migrations)';

    public function handle(): int
    {
        $this->info('Installing Icon package...');

        /**
         * 1. Publish assets
         */
        $this->call('vendor:publish', [
            '--tag' => 'icon-assets',
            '--force' => true,
        ]);

        /**
         * 2. Publish routes
         */
        $this->call('vendor:publish', [
            '--tag' => 'icon-routes',
            '--force' => true,
        ]);

        /**
         * 3. Publish views (optional)
         */
        $this->call('vendor:publish', [
            '--tag' => 'icon-views',
            '--force' => true,
        ]);

        /**
         * 4. Run migrations
         */
        $this->call('migrate');

        $this->info('Icon package installed successfully.');

        return self::SUCCESS;
    }
}