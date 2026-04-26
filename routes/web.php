<?php

use Illuminate\Support\Facades\Route;

Route::get('/',                  fn() => view('catalog.index'))->name('catalog.index');
Route::get('/books/create',      fn() => view('books.create'))->name('books.create');
Route::get('/books/{id}',        fn() => view('books.show'))->name('books.show');
Route::get('/profile',           fn() => view('profile.index'))->name('profile.index');
Route::get('/admin/categories',  fn() => view('admin.categories'))->name('admin.categories');
Route::get('/admin/disputes',    fn() => view('admin.disputes'))->name('admin.disputes');
Route::get('/contact',           fn() => view('contact'))->name('contact');
Route::get('/login',             fn() => view('auth.login'))->name('login');
Route::get('/register',          fn() => view('auth.register'))->name('register');
