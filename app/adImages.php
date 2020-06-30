<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class adImages extends Model
{
    protected $primaryKey='id';
    protected $table='adimages';
    Protected $fillable=array('name','adId',
        'created_at','updated_at');
    public function images()
    {
        return $this->belongsTo(Ads::class,"adId");
    }
}
