<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/books', [BookController::class, 'index'])->name('book');
});

Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
    Route::patch('/book/{id}/update', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{id}/destroy', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/book/print', [BookController::class, 'printToPdf'])->name('book.print');
    Route::get('/book/export', [BookController::class, 'export'])->name('book.export');
    Route::post('/book/import', [BookController::class, 'import'])->name('book.import');
});


Route::middleware(['auth', 'role:Admin'])->prefix('branches')->group(function () {
    Route::get('/', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('/{branch}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');
    Route::get('/{branch}', [BranchController::class, 'show'])->name('branches.show');
});


require __DIR__ . '/auth.php';
