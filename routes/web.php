<?php

use App\Livewire\Acquisitions\Oc\OcView;
use App\Livewire\Acquisitions\Orm\OrmList;
use App\Livewire\Acquisitions\Orm\OrmCreate;
use App\Livewire\Productos\ProductIndex;
use App\Livewire\Productos\ProductCreate;
use App\Livewire\Categorias\CategoryIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintOrmController;
use App\Livewire\Acquisitions\Oc\OcCreate;
use App\Livewire\Acquisitions\Oc\OcList;
use App\Livewire\Acquisitions\Orm\OrmView;
use App\Livewire\RRHH\Users\UserList;
use App\Livewire\Bodega\Index;
use App\Livewire\Bodega\Ingreso;
use App\Livewire\Bodega\Traspaso;
use App\Livewire\Bodega\Show;
use App\Livewire\Dashboard;

Route::view('/', 'welcome');


Route::middleware(['auth', 'active.user'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('permission:dashboard');
    
    Route::prefix('bodegas')->name('bodegas.')->group(function () {
        Route::get('/ingreso', Ingreso::class)->name('ingreso')->middleware('permission:bodegas.ingreso');
        Route::get('/traspaso', Traspaso::class)->name('traspaso')->middleware('permission:bodegas.traspaso');
        Route::get('/{bodega}', Show::class)->name('show')->middleware('permission:bodegas.show');
        Route::get('/', Index::class)->name('index')->middleware('permission:bodegas.view');
    });

    Route::prefix('oc')->name('oc.')->group(function () {
        Route::get('/create/{detalles}', OcCreate::class)->name('create')->middleware('permission:oc.create');
        Route::get('/{id}', OcView::class)->name('show')->middleware('permission:oc.show');
        Route::get('/', OcList::class)->name('index')->middleware('permission:oc.index');
    });

    Route::prefix('orm')->name('orm.')->group(function () {
        Route::get('/create', OrmCreate::class)->name('create')->middleware('permission:orm.create');
        Route::get('/{id}', OrmView::class)->name('show')->middleware('permission:orm.show');
        Route::get('/', OrmList::class)->name('index')->middleware('permission:orm.index');
        Route::get('/print/{id}', [PrintOrmController::class, 'print'])->name('print')->middleware('permission:orm.print');
    });

    Route::get('/users', UserList::class)->name('users')->middleware('permission:users.index');

    Route::prefix('productos')->name('products.')->group(function () {
        Route::get('/', ProductIndex::class)->name('index')->middleware('permission:products.index');
        Route::get('/create', ProductCreate::class)->name('create')->middleware('permission:products.create');
    });
    Route::prefix('categorias')->name('categories.')->group(function () {
        Route::get('/', CategoryIndex::class)->name('index')->middleware('permission:categories.index');
    });
});

require __DIR__ . '/auth.php';
