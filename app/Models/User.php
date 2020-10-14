<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    // use MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
