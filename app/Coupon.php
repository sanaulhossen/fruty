<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $fillable = ['coupon_name', 'coupon_discount', 'coupon_description', 'minimum_purchase_amount', 'validity_till'];
}
