<?php

use Illuminate\Support\Facades\Route;
use Vendor\ContactForm\Http\Controllers\AdminContactController;

Route::middleware(['web', 'auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/contact-submissions', [AdminContactController::class, 'index'])->name('contact-submissions.index');
    Route::delete('/contact-submissions/{id}', [AdminContactController::class, 'destroy'])->name('contact-submissions.destroy');
});
