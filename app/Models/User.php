<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'password', 
        'photo',
        'phone', 
        'address',
        'city', 
        'zipcode', 
        'country',
        'gender',
        'dob', 
        'provider', 
        'provider_id',
        'is_active',
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


    /**
     * user types
     *
     * @var array
     */
    public static function getTypes()
    {
        return [
            'customer' => 'c',
            'merchant' => 'm',
            'admin' => 'a'
        ];
    }


    public function scopeMerchant($query)
    {
        $userTypes = self::getTypes();
        $query->where('type', $userTypes['merchant']);
    }

    public static function isCustomer(){
        return \Auth::user()->type == self::getTypes()['customer'];
    }
}
