<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HelpCenterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return view('auth.no-session');
})->middleware(['guest']);

Route::get('/pusat-bantuan', [HelpCenterController::class, 'index'])->middleware(['guest']);

Route::post('/borrowingss', [BorrowingController::class, 'stores'])->middleware(['auth', 'role:member'])->name('borrowings.store');








Route::get('/contents/user-pictures/{path}', [ContentController::class, 'userPictures'])->name('user-pictures');
Route::get('/contents/book-covers/{path}', [ContentController::class, 'bookCovers'])->name('book-covers');

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth'])->name('home.index');
Route::get('/home/book-detail/{book}', [HomeController::class, 'bookDetail'])->middleware(['auth', 'role:member'])->name('home.bookDetail');


Route::get('/page/survey', [PageController::class, 'survey'])->middleware(['auth'])->name('page.survey');

Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware(['auth'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->middleware(['auth'])->name('profile.update');
Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->middleware(['auth'])->name('profile.changePassword');
Route::put('/profile/change-password', [ProfileController::class, 'updatePassword'])->middleware(['auth'])->name('profile.updatePassword');
Route::post('/profile/picture', [ProfileController::class, 'removePicture'])->middleware(['auth'])->name('profile.removePicture');
Route::post('/profile/change-picture', [ProfileController::class, 'changePicture'])->middleware(['auth'])->name('profile.changePicture');
Route::get('/profile/borowings', [ProfileController::class, 'borrowings'])->middleware(['auth', 'role:member'])->name('profile.borrowings');
Route::get('/profile/borowings/{borrowing}', [ProfileController::class, 'borrowingDetail'])->middleware(['auth', 'role:member'])->name('profile.borrowingDetail');
Route::get('/roles', [RoleController::class, 'index'])->middleware(['auth', 'permission:read.roles'])->name('role.index');

Route::get('/users', [UserController::class, 'index'])->middleware('auth', 'permission:read.users')->name('user.index');
Route::get('/users/create', [UserController::class, 'create'])->middleware('auth', 'permission:create.users')->name('user.create');
Route::post('/users', [UserController::class, 'store'])->middleware('auth', 'permission:create.users')->name('user.store');
Route::get('/users/{user}', [UserController::class, 'show'])->middleware(['auth', 'permission:read.users'])->name('user.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('auth', 'permission:update.users')->name('user.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth', 'permission:update.users')->name('user.update');
Route::get('/users/{user}/delete', [UserController::class, 'delete'])->middleware('auth', 'permission:delete.users')->name('user.delete');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth', 'permission:delete.users')->name('user.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->middleware(['auth', 'permission:read.categories'])->name('category.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->middleware(['auth', 'permission:create.categories'])->name('category.create');
Route::post('/categories', [CategoryController::class, 'store'])->middleware(['auth', 'permission:create.categories'])->name('category.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware(['auth', 'permission:update.categories'])->name('category.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->middleware(['auth', 'permission:update.categories'])->name('category.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->middleware(['auth', 'permission:delete.categories'])->name('category.destroy');

Route::get('/racks', [RackController::class, 'index'])->middleware(['auth', 'permission:read.racks'])->name('rack.index');
Route::get('/racks/create', [RackController::class, 'create'])->middleware(['auth', 'permission:create.racks'])->name('rack.create');
Route::post('/racks', [RackController::class, 'store'])->middleware(['auth', 'permission:create.racks'])->name('rack.store');
Route::get('/racks/{rack}/edit', [RackController::class, 'edit'])->middleware(['auth', 'permission:update.racks'])->name('rack.edit');
Route::put('/racks/{rack}', [RackController::class, 'update'])->middleware(['auth', 'permission:update.racks'])->name('rack.update');
Route::delete('/racks/{rack}', [RackController::class, 'destroy'])->middleware(['auth', 'permission:delete.racks'])->name('rack.destroy');

Route::get('/publishers', [PublisherController::class, 'index'])->middleware(['auth', 'permission:read.publishers'])->name('publisher.index');
Route::get('/publishers/create', [PublisherController::class, 'create'])->middleware(['auth', 'permission:create.publishers'])->name('publisher.create');
Route::post('/publishers', [PublisherController::class, 'store'])->middleware(['auth', 'permission:create.publishers'])->name('publisher.store');
Route::get('/publishers/{publisher}/edit', [PublisherController::class, 'edit'])->middleware(['auth', 'permission:update.publishers'])->name('publisher.edit');
Route::put('/publishers/{publisher}', [PublisherController::class, 'update'])->middleware(['auth', 'permission:update.publishers'])->name('publisher.update');
Route::delete('/publishers/{publisher}', [PublisherController::class, 'destroy'])->middleware(['auth', 'permission:delete.publishers'])->name('publisher.destroy');

Route::get('/books', [BookController::class, 'index'])->middleware(['auth', 'permission:read.books'])->name('book.index');
Route::get('/books/create', [BookController::class, 'create'])->middleware(['auth', 'permission:create.books'])->name('book.create');
Route::post('/books', [BookController::class, 'store'])->middleware(['auth', 'permission:create.books'])->name('book.store');
Route::get('/books/{book}', [BookController::class, 'show'])->middleware(['auth', 'permission:read.books'])->name('book.show');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->middleware(['auth', 'permission:update.books'])->name('book.edit');
Route::put('/books/{book}', [BookController::class, 'update'])->middleware(['auth', 'permission:update.books'])->name('book.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->middleware(['auth', 'permission:delete.books'])->name('book.destroy');

Route::get('/borrowings', [BorrowingController::class, 'index'])->middleware(['auth', 'permission:read.borrowings'])->name('borrowing.index');
Route::get('/borrowings/create', [BorrowingController::class, 'create'])->middleware(['auth', 'permission:create.borrowings'])->name('borrowing.create');
Route::post('/borrowings', [BorrowingController::class, 'store'])->middleware(['auth', 'permission:create.borrowings'])->name('borrowing.store');
Route::get('/borrowings/by-user/{user}', [BorrowingController::class, 'showByUser'])->middleware(['auth', 'permission:read.borrowings'])->name('borrowing.showByUser');
Route::get('/borrowings/{borrowing}/edit', [BorrowingController::class, 'edit'])->middleware(['auth', 'permission:update.borrowings'])->name('borrowing.edit');
Route::put('/borrowings/{borrowing}/return', [BorrowingController::class, 'return'])->middleware(['auth', 'permission:update.borrowings'])->name('borrowing.return');
Route::get('/borrowings/{borrowing}', [BorrowingController::class, 'show'])->middleware(['auth', 'permission:read.borrowings'])->name('borrowing.show');
Route::put('/borrowings/{borrowing}', [BorrowingController::class, 'update'])->middleware(['auth', 'permission:update.borrowings'])->name('borrowing.update');
Route::delete('/borrowings/{borrowing}', [BorrowingController::class, 'destroy'])->middleware(['auth', 'permission:delete.borrowings'])->name('borrowing.destroy');

Route::get('/reports', [ReportController::class, 'index'])->middleware(['auth', 'permission:create.reports'])->name('report.index');
Route::get('/reports/borrowings', [ReportController::class, 'borrowings'])->middleware(['auth', 'permission:create.reports'])->name('report.borrowings');

Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlist.index');
Route::put('/wishlists/{book}/add-or-remove', [WishlistController::class, 'addOrRemove'])->name('wishlist.add-or-remove');
