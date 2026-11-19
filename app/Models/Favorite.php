<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';
    protected $primaryKey = 'Favorite_ID';
    protected $fillable = ['User_ID', 'Group_ID', 'Instrument_ID'];
    public $timestamps = false;
}
