<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Livewire\OrgTables;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('org', \App\Http\Livewire\Orgs::class)->name('org');
Route::middleware(['auth:sanctum', 'verified'])->get('device', \App\Http\Livewire\Devices::class)->name('device');
Route::middleware(['auth:sanctum', 'verified'])->get('person', \App\Http\Livewire\Teachers::class)->name('person');
Route::middleware(['auth:sanctum', 'verified'])->get('lending', \App\Http\Livewire\Lendings::class)->name('lending');
