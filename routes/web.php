<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintOrmController;
use App\Livewire\Acquisitions\Oc\OcCreate;
use App\Livewire\Acquisitions\Oc\OcList;
use App\Livewire\RRHH\Users\UserList;
use App\Livewire\Bodega\Index;
use App\Livewire\Bodega\Ingreso;
use App\Livewire\Bodega\Traspaso;
use App\Livewire\Bodega\Show;

Route::view('/', 'welcome');


Route::middleware(['auth', 'active.user'])->group(function () {
    Route::prefix('bodegas')->name('bodegas.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/ingreso', Ingreso::class)->name('ingreso');
        Route::get('/traspaso', Traspaso::class)->name('traspaso');
        Route::get('/{bodega}', Show::class)->name('show');
    });

    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');

    Route::get('/oc/{oc}', function ($oc) {
        return view('pages.acquisitions.oc-view', ['oc' => $oc]);
    })->name('oc.view');

    Route::get('/orm/{orm}', function ($orm) {
        return view('pages.acquisitions.orm-view', ['orm' => $orm]);
    })->name('orm.view');

    Route::get('/create/orm', function () {
        return view('pages.acquisitions.orm-create');
    })->name('create');

    Route::get('/orm', function () {
        return view('pages.acquisitions.orm');
    })->name('orm');
    Route::get('/orm/print/{id}', [PrintOrmController::class, 'print'])->name('orm.print');


    Route::get('/oc/create/{detalles}', OcCreate::class)->name('oc.create');


    Route::get('/oc', OcList::class)->name('oc');

    Route::get('/users', UserList::class)->name('users');
});

require __DIR__ . '/auth.php';
