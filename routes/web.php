<?php

use App\Http\Controllers\GirlsProfileController;
use App\Http\Controllers\ProfileController;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
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
    return redirect()->route('login');
})->name('home');

// Profils protégés (accès restreint par ancienneté)
Route::middleware('auth')->group(function () {
    Route::get('/profiles', [GirlsProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/{profile}', [GirlsProfileController::class, 'show'])->name('profiles.show');
});

// Routes d'abonnement et contact
Route::get('/abonnement', function () {
    return view('abo');
})->name('abo');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        // Show only the first profile on dashboard; details page controls photo count
        $profiles = Profile::orderBy('order_index')->take(1)->get();
        return view('dashboard', compact('user', 'profiles'));
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});

// TEMP: One-time route to create/reset a test user in production without SSH
Route::get('/__create_test_user', function (Request $request) {
    // Only allow in production
    abort_unless(app()->environment(['production', 'prod', 'live']), 403);
    
    // Simple token gate. Change this value and remove the route after use.
    $provided = (string) $request->query('token');
    $expected = 'g1rls1a-test-seed-2025';
    abort_unless(hash_equals($expected, $provided), 403);

    $login = 'testprod';
    $email = 'testprod@example.com';
    $password = 'MonSuperMot2Passe!'; // Will be hashed by model cast

    $user = User::updateOrCreate(
        ['login' => $login],
        [
            'email' => $email,
            'password' => $password,
            'credit_ia' => 0,
            'subscribed' => false,
        ]
    );

    return response()->json([
        'ok' => true,
        'login' => $login,
        'password' => $password,
        'user_id' => $user->id,
    ]);
})->name('tmp.create_test_user');

require __DIR__.'/auth.php';
