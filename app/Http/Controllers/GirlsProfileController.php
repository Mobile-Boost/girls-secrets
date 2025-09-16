<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GirlsProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }
        // Show only the first profile in the catalog; photos are progressively unlocked
        $profiles = Profile::orderBy('order_index')->take(1)->get();
        return view('profiles.index', compact('profiles'));
    }

    public function show(Profile $profile)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }
        // Only the first profile is viewable; photos inside are progressively unlocked
        $firstProfileId = Profile::orderBy('order_index')->value('id');
        abort_unless($profile->id === $firstProfileId, 403, 'Profil verrouillé');

        $unlockedPhotos = $user->unlockedPhotosCount();

        $totalPhotos = is_array($profile->photos) ? count($profile->photos) : 0;
        $hasLocked = $unlockedPhotos < $totalPhotos;

        $daysSinceSignup = $user->created_at?->diffInDays(now()) ?? 0;
        $mod = $daysSinceSignup % 7;

        // Today unlocks a new photo only on multiples of 7 after signup (excluding day 0)
        $todayUnlock = ($daysSinceSignup > 0) && ($mod === 0) && $hasLocked;
        $daysUntilNext = $todayUnlock ? 0 : (7 - $mod);
        if ($daysSinceSignup === 0) {
            $daysUntilNext = 7; // brand new user: next unlock in 7 days
        }

        $lastUnlockBaseDays = intdiv($daysSinceSignup, 7) * 7;
        $lastUnlockDate = $user->created_at?->copy()->addDays($lastUnlockBaseDays)->format('d/m/Y');

        return view('profiles.show', compact('profile', 'unlockedPhotos', 'daysUntilNext', 'todayUnlock', 'lastUnlockDate'));
    }
}