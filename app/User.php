<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Adde by Jayed Hasan Start
use Illuminate\Database\Eloquent\SoftDeletes;
// Adde by Jayed Hasan End

class User extends Authenticatable
{
    use Notifiable;

    // Adde by Jayed Hasan Start
    use SoftDeletes;

    // Relationship
    function myStore()
    {
      return $this->hasOne('App\Stores');
    }
    function assignedStores()
    {
      return $this->belongsToMany('App\Stores', 'roles_stores', 'user_id', 'store_id');
    }
    function cart()
    {
      return $this->hasMany('App\Cart');
    }
    // Adde by Jayed Hasan End

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'username', 'mobile', 'mobile_verified_at', 'dob', 'nidn', 'nidn_verified_at', 'brn', 'brn_verified_at', 'gender', 'address', 'email', 'email_verified_at', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
