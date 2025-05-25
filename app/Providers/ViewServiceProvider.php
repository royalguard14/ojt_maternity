<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Profile;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
{
    // Pass profile and modules to master and master-front layouts
    View::composer(['layouts.master', 'layouts.master-front'], function ($view) {
        if (Auth::check()) {
            $profile = Profile::where('user_id', Auth::id())->first();
            $view->with('profile', $profile);

            $role = Auth::user()->role;
            $modules = Module::whereIn('id', $role->modules)->get();

            $view->with('modules', $modules);
        }
    });
}












}
