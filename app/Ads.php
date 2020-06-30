<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $primaryKey='id';
    protected $table='ads';
    protected $fillable=array(
        'userId',
        'carBrand',
        'carModel',
        'regions',
        'city',
        'carEngine',
        'milage',
        'ownersCount',
        'created_at',
        'updated_at');
    public function image()
    {
        return $this->hasMany(adImages::class,"adId","id");
    }
}
