<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'phone_id',
        'language_id',
    ];

    /**
     * Relasi: User punya banyak foto
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Relasi: User punya banyak pembayaran
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * (Opsional) Jika kamu masih punya tabel user_choices
     */
    public function choices()
    {
        return $this->hasMany(UserChoice::class);
    }
}
