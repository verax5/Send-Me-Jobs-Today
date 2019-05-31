<?php namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = [
        'name', 'keyword', 'location', 'email', 'subscribed', 'last_jobs_fetch_attempt', 'confirmation_token',
        'direct_login_token', 'password', 'status', 'signup_type',
    ];

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}