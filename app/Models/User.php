<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'credit_ia',
        'msisdn',
        'subscription_id',
        'subscribed',
        'unsub_at',
        'last_rebill_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'unsub_at' => 'datetime',
            'last_rebill_at' => 'datetime',
            'subscribed' => 'boolean',
            'credit_ia' => 'integer',
            'password' => 'hashed',
        ];
    }

    public function autologTokens()
    {
        return $this->hasMany(AutologToken::class);
    }

    /**
     * Compute how many profiles the user has unlocked based on account age.
     * Starts at 1 on signup, unlocks +1 every 7 days, capped at 10.
     */
    public function unlockedProfilesCount(): int
    {
        if (! $this->created_at instanceof Carbon) {
            return 1;
        }

        $daysSinceSignup = $this->created_at->diffInDays(Carbon::now());
        $additional = intdiv($daysSinceSignup, 7);
        return min(10, 1 + $additional);
    }

    /**
     * Compute how many photos are unlocked (per active profile) based on account age.
     * Starts at 1 on signup, unlocks +1 every 7 days.
     */
    public function unlockedPhotosCount(): int
    {
        if (! $this->created_at instanceof Carbon) {
            return 1;
        }

        $daysSinceSignup = $this->created_at->diffInDays(Carbon::now());
        return 1 + intdiv($daysSinceSignup, 7);
    }
}
