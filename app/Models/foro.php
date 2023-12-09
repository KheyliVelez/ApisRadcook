<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    protected $table = 'foros';
    protected $guarded = [];
    protected $fillable = ['user_id', 'description'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
