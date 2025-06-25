<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupGoogleOAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oauth:setup-google';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Google OAuth configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Google OAuth Setup Helper');
        $this->line('');

        // Check current configuration
        $this->info('📋 Current Configuration:');
        $this->table(
            ['Setting', 'Value', 'Status'],
            [
                ['Client ID', config('services.google.client_id') ?: 'Not set', config('services.google.client_id') ? '✅' : '❌'],
                ['Client Secret', config('services.google.client_secret') ? str_repeat('*', 20) : 'Not set', config('services.google.client_secret') ? '✅' : '❌'],
                ['Redirect URI', config('services.google.redirect') ?: 'Not set', config('services.google.redirect') ? '✅' : '❌'],
                ['App URL', config('app.url'), '✅'],
            ]
        );

        $this->line('');

        // Check if configuration is complete
        if (config('services.google.client_id') && config('services.google.client_secret') && config('services.google.redirect')) {
            $this->info('✅ Google OAuth is configured!');
            
            if ($this->confirm('Do you want to test the configuration?')) {
                $this->testConfiguration();
            }
        } else {
            $this->warn('⚠️  Google OAuth is not fully configured.');
            $this->setupConfiguration();
        }

        $this->line('');
        $this->info('📚 For detailed setup instructions, check:');
        $this->line('   • /auth/google/debug (in browser)');
        $this->line('   • GOOGLE_OAUTH_FIX.md file');
        $this->line('   • https://console.cloud.google.com/');

        return 0;
    }

    private function setupConfiguration()
    {
        $this->line('');
        $this->info('🛠️  Let\'s setup Google OAuth:');

        if ($this->confirm('Do you want to configure Google OAuth now?')) {
            $clientId = $this->ask('Enter Google Client ID');
            $clientSecret = $this->secret('Enter Google Client Secret');
            
            if ($clientId && $clientSecret) {
                $this->updateEnvFile($clientId, $clientSecret);
                $this->info('✅ Configuration saved to .env file');
                $this->warn('⚠️  Please restart your Laravel server for changes to take effect');
            }
        }

        $this->line('');
        $this->info('📋 Next steps:');
        $this->line('1. Go to https://console.cloud.google.com/');
        $this->line('2. Create or select a project');
        $this->line('3. Enable Google+ API');
        $this->line('4. Create OAuth 2.0 credentials');
        $this->line('5. Add authorized redirect URI: ' . config('app.url') . '/auth/google/callback');
    }

    private function testConfiguration()
    {
        $this->line('');
        $this->info('🧪 Testing Google OAuth configuration...');

        try {
            // Test if we can create the redirect URL
            $redirectUrl = route('auth.google');
            $this->info('✅ Redirect URL: ' . $redirectUrl);

            // Check if routes are registered
            if (\Route::has('auth.google') && \Route::has('auth.google.callback')) {
                $this->info('✅ OAuth routes are registered');
            } else {
                $this->error('❌ OAuth routes are not registered');
            }

            // Check if Socialite is installed
            if (class_exists(\Laravel\Socialite\Facades\Socialite::class)) {
                $this->info('✅ Laravel Socialite is installed');
            } else {
                $this->error('❌ Laravel Socialite is not installed');
                $this->line('   Run: composer require laravel/socialite');
            }

        } catch (\Exception $e) {
            $this->error('❌ Configuration test failed: ' . $e->getMessage());
        }
    }

    private function updateEnvFile($clientId, $clientSecret)
    {
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        // Update or add Google OAuth settings
        $redirectUri = config('app.url') . '/auth/google/callback';

        $patterns = [
            '/^GOOGLE_CLIENT_ID=.*$/m' => 'GOOGLE_CLIENT_ID=' . $clientId,
            '/^GOOGLE_CLIENT_SECRET=.*$/m' => 'GOOGLE_CLIENT_SECRET=' . $clientSecret,
            '/^GOOGLE_REDIRECT_URI=.*$/m' => 'GOOGLE_REDIRECT_URI=' . $redirectUri,
        ];

        foreach ($patterns as $pattern => $replacement) {
            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                $envContent .= "\n" . $replacement;
            }
        }

        file_put_contents($envPath, $envContent);
    }
}