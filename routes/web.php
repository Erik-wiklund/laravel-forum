<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('forum.index');
});

Route::resource('forum', ForumController::class)
->only('index', 'show');

// routes/web.php

// Route for displaying threads within a subcategory
Route::get('/subcategories/{subcategory}/threads', [ThreadController::class, 'index'])
    ->name('subcategories.threads.index');

// Route for displaying an individual thread
Route::get('/subcategories/{subcategory}/threads/{thread}', [ThreadController::class, 'show'])
    ->name('subcategories.threads.show');

    Route::get('/threads/{id}/content', [ThreadController::class, 'show'])
    ->name('thread-content.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
