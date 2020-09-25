<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'vendor';

    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'password', 
        'photo',
        'phone',
        'store_name',
        'store_slug',
        'brand_logo',
        'brand_banner',
        'gender',
        'dob',
        'street_1',
        'street_2', 
        'city', 
        'zipcode',
        'state', 
        'country',
        'banking_type',
        'account_name',
        'account_number',
        'bank_name',
        'branch_name',
        'commission_percent',
        'provider',
        'provider_id',
        'is_featured',
        'is_active',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
