<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SubCategoryController;
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



Route::get('/threads/{id}/content', [ReplyController::class, 'show'])
    ->name('thread-content.show');
Route::middleware(['auth'])->group(function () {
    Route::get('/subcategories/{subcategory}/threads/create', [ThreadController::class, 'create'])
        ->name('threads.create');
    Route::post('/subcategories/{subcategory}/threads', [ThreadController::class, 'store'])
        ->name('threads.store');
    Route::post('/subcategories/{subcategory}/threads/{thread}', [ReplyController::class, 'create'])->name('reply.create');
});
Route::get('/threads/{id}/contents', [ReplyController::class, 'index'])
    ->name('thread-content.index');

    Route::middleware(['is.admin.or.mod'])->group(function () {
        Route::post('/update-thread-checkbox/{thread}', [ThreadController::class, 'updateCheckboxValue']);
    });
        

    

Route::group(['middleware' => 'is.admin', 'prefix' => 'admin'], function () {
    // Admin Dashboard Routes
    Route::get('/dashboard', [AdminDashboardController::class, 'home'])->name('admin.home');
    Route::get('/settings', [AdminSettingsController::class, 'settings'])->name('admin.settings');

    // User Routes
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{userId}', [UserController::class, 'show'])->name('user.show');

    // Category Routes
    Route::get('/dashboard/category/new', [CategoryController::class, 'create'])->name('category.new');
    Route::post('/dashboard/category/new', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/dashboard/category/edit/{categoryId}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/dashboard/category/update/{categoryId}', [CategoryController::class, 'update'])->name('category.update');

    // Subcategory Routes
    Route::get('/dashboard/subcategory/new', [SubCategoryController::class, 'create'])->name('subcategory.new');
    Route::post('/dashboard/subcategory/new', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/dashboard/subcategories', [SubCategoryController::class, 'index'])->name('subcategories');
    Route::get('/dashboard/subcategory/edit/{subcategoryId}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/dashboard/subcategory/update/{subcategoryId}', [SubCategoryController::class, 'update'])->name('subcategory.update');

    // User Routes in admin
    Route::get('/dashboard/users/new', [UserController::class, 'create'])->name('user.new');
    Route::post('/dashboard/users/new', [UserController::class, 'store'])->name('user.store');
    Route::get('/dashboard/users/edit/{userId}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/dashboard/users/update/{userId}', [UserController::class, 'update'])->name('user.update');
    Route::post('/forum/banuser/{userId}', [UserController::class, 'add_forum_ban'])->name('forum.ban');
    Route::get('/forum/banuser/{userId}', [UserController::class, 'del_forum_ban'])->name('forum.unban');

    // Chat Routes
    Route::delete('/chat/{message}', [ChatController::class, 'destroy'])->name('chat.destroy');
    Route::delete('/chat/purge/{id}', [ChatController::class, 'purge'])->name('chat.purge');
    Route::post('/chat/banuser/{id}/{userId}', [ChatController::class, 'ban'])->name('chat.ban');
    Route::get('/shoutbox/bans/{userId}', [UserController::class, 'del_shoutbox_ban'])->name('chat.unban');
    Route::post('/shoutbox/banuser/{userId}', [UserController::class, 'add_shoutbox_ban'])->name('chat.banUser');

    // Contact form messages 
    Route::get('/dashboard/contact-messages', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/dashboard/contact-message/{messageId}', [ContactController::class, 'show'])->name('contact.show');
});




Route::middleware('auth', 'web')->group(function () {
    Route::get('/profile/{userId}', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{userId}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Outside auth to display for guests
Route::middleware('web')->group(function () {
    Route::get('/user/profile/{user}', [ProfileController::class, 'show'])->name('profile.show_modal');
});

Route::middleware(['auth'])->group(function () {
    // Show the chatbox
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

    // Handle sending chat messages
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

Route::get('/online-users', [ForumController::class, 'showOnlineUsers'])->name('online-users');

Route::middleware('web')->group(function () {
    Route::get('/subcategories/{subcategory}/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
    // Other thread-related routes
});

// Contact form and save to db
Route::get('/misc/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/misc/contact/message', [ContactController::class, 'store'])->name('contact.store');


require __DIR__ . '/auth.php';
