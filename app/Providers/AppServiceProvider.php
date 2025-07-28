<?php

namespace App\Providers;

use App\Http\Reponses\LogoutResponse as ReponsesLogoutResponse;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Livewire\JoinClassroom;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogoutResponseContract::class, ReponsesLogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('join-classroom', JoinClassroom::class);

        RateLimiter::for('filament-login', function (Request $request) {
            return Limit::perMinute(50)->by($request->ip());
        });
        
        Blade::directive('viewFileComment', function () {
            return "<?php echo \"<!-- View file: \" . __FILE__ . \" -->\"; ?>";
        });
    }
   

    
}
