<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class podcast extends Model
{
    use HasFactory;
    protected $fillable = [
        'titel',
        'desc',
        'imgUrl',
        'audioUrl'
    ];
    public function podcastAuthor()
    {
       return $this->belongsToMany('App\Models\User','podcast_authors','podcast_id','user_id')->withPivot('comment','id');
    }

  

}
