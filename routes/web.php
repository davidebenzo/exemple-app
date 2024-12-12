<?php

use App\Http\Controllers\CommercialActivitiesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('commercial-activities')->name('commercial-activities.')->group(function () {
    // Rotta per visualizzare l'elenco delle attività commerciali
    Route::get('/', [CommercialActivitiesController::class, 'index'])->name('index');

    // Rotta per visualizzare il modulo di creazione
    Route::get('/create', [CommercialActivitiesController::class, 'create'])->name('create');

    // Rotta per salvare una nuova attività commerciale
    Route::post('/', [CommercialActivitiesController::class, 'store'])->name('store');

    // Rotta per visualizzare il modulo di modifica di un'attività commerciale
    Route::get('/{commercialActivity}/edit', [CommercialActivitiesController::class, 'edit'])->name('edit');

    // Rotta per aggiornare un'attività commerciale esistente
    Route::patch('/{commercialActivity}', [CommercialActivitiesController::class, 'update'])->name('update');

    // Rotta per cancellare un'attività commerciale
    Route::delete('/{commercialActivity}', [CommercialActivitiesController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
