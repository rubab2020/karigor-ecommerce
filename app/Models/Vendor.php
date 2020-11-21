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
        'shop_name',
        'shop_slug',
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


    public static function getVendorName($vid) {
        return self::where('id', $vid)->value('name');
    }

    public static function getStoreSlug($vid) {
        return self::where('id', $vid)->value('shop_slug');
    }

    public static function getStoreIdBySlug($slug) {
        $id = self::where('shop_slug', $slug)->select('id')->first();
        if($id)
            return $id->id;
        return null;    
    }
}
