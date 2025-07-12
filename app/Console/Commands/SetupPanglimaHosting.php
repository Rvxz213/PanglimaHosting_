<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SetupPanglimaHosting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'panglima:setup {--force : Force setup even if already configured}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup PanglimaHosting application with initial data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Setting up PanglimaHosting...');

        // Check if already setup
        if (User::count() > 0 && !$this->option('force')) {
            $this->warn('Application appears to be already set up. Use --force to reinstall.');
            return;
        }

        // Run migrations
        $this->info('📊 Running migrations...');
        Artisan::call('migrate:fresh', ['--force' => true]);
        $this->info('✅ Migrations completed');

        // Run seeders
        $this->info('🌱 Seeding database...');
        Artisan::call('db:seed', ['--force' => true]);
        $this->info('✅ Database seeded');

        // Clear caches
        $this->info('🧹 Clearing caches...');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        $this->info('✅ Caches cleared');

        // Generate application key if not exists
        if (!config('app.key')) {
            $this->info('🔑 Generating application key...');
            Artisan::call('key:generate', ['--force' => true]);
            $this->info('✅ Application key generated');
        }

        $this->info('');
        $this->info('🎉 PanglimaHosting setup completed successfully!');
        $this->info('');
        $this->info('📋 Default credentials:');
        $this->info('   Admin Email: admin@panglimahosting.com');
        $this->info('   Admin Password: admin123');
        $this->info('');
        $this->info('🌐 Next steps:');
        $this->info('   1. Configure your .env file with database and Midtrans credentials');
        $this->info('   2. Run: php artisan serve');
        $this->info('   3. Visit: http://localhost:8000');
        $this->info('   4. Admin panel: http://localhost:8000/admin/login');
        $this->info('');
        $this->info('📚 For more information, check the README.md file');
    }
} 