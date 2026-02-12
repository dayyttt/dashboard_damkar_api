<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('sectors', App\Http\Controllers\SectorController::class);
    Route::get('regu', [App\Http\Controllers\ReguController::class, 'index'])->name('regu.index');
    Route::resource('members', App\Http\Controllers\MemberController::class);
    Route::get('reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [App\Http\Controllers\ReportController::class, 'export'])->name('reports.export');
    Route::get('search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
    Route::get('api/search', [App\Http\Controllers\SearchController::class, 'api'])->name('api.search');
    Route::get('settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');
    
    // Manual Attendance Management
    Route::resource('manual-attendance', App\Http\Controllers\ManualAttendanceController::class);
    
    // Fake GPS Logs
    Route::get('fake-gps-logs', [App\Http\Controllers\FakeGpsLogController::class, 'index'])->name('fake-gps-logs.index');
    Route::post('fake-gps-logs/{id}/mark-read', [App\Http\Controllers\FakeGpsLogController::class, 'markAsRead'])->name('fake-gps-logs.mark-read');
    Route::post('fake-gps-logs/mark-all-read', [App\Http\Controllers\FakeGpsLogController::class, 'markAllAsRead'])->name('fake-gps-logs.mark-all-read');
    Route::delete('fake-gps-logs/{id}', [App\Http\Controllers\FakeGpsLogController::class, 'destroy'])->name('fake-gps-logs.destroy');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
