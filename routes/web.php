<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServersController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SitesController;
use App\Http\Middleware\CheckForFirstTimeInstallation;
use App\Http\Middleware\FirstTimInstallation;
use App\Models\Server;
use App\Models\Site;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::redirect('/', '/home');

Route::get('install.sh', function () {
    return response(
        view('scripts.install', [
            'server' => new Server([
                'sudoer_username' => 'roost',
                'sudoer_password' => Str::random(16),
            ]),
            'site' => new Site([
                'domain' => '',
            ]),
        ])
    )->withHeaders([
        'Content-Type' => 'text/plain',
    ]);
});

Route::middleware([CheckForFirstTimeInstallation::class])->group(function () {
    Route::get('signin', [SigninController::class, 'create'])->name('signin.create');
    Route::post('signin', [SigninController::class, 'store'])->name('signin.store');
});

Route::middleware([FirstTimInstallation::class])->group(function () {
    Route::get('setup', [SetupController::class, 'create'])->name('setup.create');
    Route::post('setup', [SetupController::class, 'store'])->name('setup.store');
});

Route::middleware([CheckForFirstTimeInstallation::class, 'auth:web'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::resource('servers', ServersController::class);

    Route::resource('sites', SitesController::class)->only('index');
    Route::resource('servers.sites', SitesController::class)->except('index');
});
