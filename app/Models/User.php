<?php

namespace App\Models;

use Storage;
use Laravel\Passport\HasApiTokens;
use App\Traits\Friendable;
use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use Friendable;
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','slug','gender','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post')
                    ->orderBy('created_at');
    }

    public function getAvatarAttribute($avatar)
    {
        return asset(Storage::url($avatar));
    }

    
}
