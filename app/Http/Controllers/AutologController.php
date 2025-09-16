<?php
namespace App\Http\Controllers;

use App\Models\AutologToken;
use Illuminate\Support\Facades\Auth;

class AutologController extends Controller
{
    public function autolog(string $token)
    {
        $autologToken = AutologToken::where('token', $token)->with('user')->first();

        if (!$autologToken || !$autologToken->isValid()) {
            return redirect()->route('login')->with('error', 'Le lien de connexion est invalide ou a expiré.');
        }

        $autologToken->update(['used' => true]);

        Auth::login($autologToken->user);

        return redirect()->route('dashboard')->with('success', 'Bienvenue sur votre espace client.');
    }
} 