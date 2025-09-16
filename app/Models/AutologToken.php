<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AutologToken extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "token",
        "user_id",
        "expires_at",
        "used",
    ];

    protected $casts = [
        "expires_at" => "datetime",
        "used" => "boolean",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateUniqueToken()
    {
        do {
            $token = Str::random(64);
        } while (self::where("token", $token)->exists());

        return $token;
    }

    public function isValid()
    {
        return !$this->used && $this->expires_at->isFuture();
    }

    public static function issueFor(User $user, int $ttlMinutes = 1440): self
    {
        return self::create([
            "token" => self::generateUniqueToken(),
            "user_id" => $user->id,
            "expires_at" => Carbon::now()->addMinutes($ttlMinutes),
            "used" => false,
        ]);
    }
}
