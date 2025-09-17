<?php

use App\Http\Controllers\MobiyoWebhookController;
use App\Http\Controllers\AutologController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductAccessController;
use App\Http\Controllers\UserAdminController;
use App\Models\WebhookLog;
use App\Models\Transaction;
use App\Models\User;
use App\Models\AutologToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ping', function () {
    return response()->json(['pong' => true]);
});

// ============================================================================
// WEBHOOKS
// ============================================================================

Route::prefix('webhooks')->group(function () {
    Route::match(['get', 'post'], 'mobiyo', [MobiyoWebhookController::class, 'handle'])->name('webhooks.mobiyo');
});

// ============================================================================
// AUTHENTIFICATION
// ============================================================================

Route::prefix('auth')->group(function () {
    Route::get('autolog/{token}', [AutologController::class, 'autolog'])
        ->name('autolog')
        ->where('token', '[A-Za-z0-9]{64}');
});

// ============================================================================
// UTILISATEURS (protégées par auth)
// ============================================================================

Route::middleware('auth')->prefix('users')->group(function () {
    
    // Accès aux produits
    Route::get('product-access', [ProductAccessController::class, 'index'])->name('product.access');
    Route::post('product-access/check', [ProductAccessController::class, 'checkAccess'])->name('product.access.check');
});

// ============================================================================
// ADMIN: création d'utilisateurs (protégé par X-Admin-Token)
// ============================================================================
Route::post('admin/users', [UserAdminController::class, 'store'])->name('admin.users.store');

