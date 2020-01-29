<?php


namespace App\models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class offer extends Model

{
protected  $table = 'offers';
protected  $fillable = [];

    public function getPreview()
    {
        $images = explode(',',$this->image );
        array_pop($images);
        if (!empty($images)){
            return '/storage/offerImg/'.$this->id.'/'.$images[0];
        }
        return '/image/default.jpg';
    }
    public function getAllImage()
    {
        $images = explode(',',$this->image );
        array_pop($images);
        if (!empty($images)){
            return $images;
        }
        return [];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
