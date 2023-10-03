<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
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



    Route::get('/threads/{id}/content', [ThreadController::class, 'show'])
    ->name('thread-content.show');
    Route::middleware(['auth'])->group(function () {
        Route::get('/subcategories/{subcategory}/threads/create', [ThreadController::class,'create'])
            ->name('threads.create');
        Route::post('/subcategories/{subcategory}/threads', [ThreadController::class,'store'])
            ->name('threads.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'home'])->name('admin.home');
        Route::get('/users', [AdminUsersController::class, 'users'])->name('admin.users');
        Route::get('/settings', [AdminSettingsController::class, 'settings'])->name('admin.settings');
        Route::get('/admin/dashboard/category/new', [CategoryController::class, 'create'])->name('category.new');
        Route::post('/admin/dashboard/category/new', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/admin/dashboard/categories', [CategoryController::class, 'index'])->name('categories');
        Route::get('/admin/dashboard/users', [UserController::class, 'index'])->name('users');
    });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
});

Route::middleware(['auth'])->group(function () {
    // Show the chatbox
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

    // Handle sending chat messages
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

Route::get('/online-users', [ForumController::class, 'showOnlineUsers'])->name('online-users');


require __DIR__.'/auth.php';