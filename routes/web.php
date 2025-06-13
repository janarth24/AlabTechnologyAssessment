<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\taskcontroller;

use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [taskcontroller::class, 'index'])->name('home');
Route::get('/blog', [taskcontroller::class, 'blog'])->name('blog');
Route::get('/ecommerce', [taskcontroller::class, 'ecommerce'])->name('ecommerce');
Route::post('/post', [taskcontroller::class, 'post'])->name('post');
Route::post('/comment', [taskcontroller::class, 'comment'])->name('comment');
Route::get('/users', [taskcontroller::class, 'viewUsers'])->name('users');
// Route::get('/users-data', [taskcontroller::class, 'ajaxUsers'])->name('users.data');
Route::put('/orders/{id}/received', [taskcontroller::class, 'markAsReceived'])->name('orders.markAsReceived');

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin', [taskcontroller::class, 'adminpage'])->name('admin.page');
});
Route::delete('/deleteuser/{id}', [taskcontroller::class, 'deleteuser'])->name('deleteuser');
Route::delete('/deletepost/{id}', [taskcontroller::class, 'deletepost'])->name('deletepost');
Route::post('/updatename/{id}', [taskcontroller::class, 'updatename'])->name('updatename');

Route::get('/sample', [taskcontroller::class, 'fetchUsers'])->name('sample');








