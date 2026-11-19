<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'Feedback_ID';
    protected $fillable = ['User_ID', 'Category_ID', 'FIO', 'Description', 'Instrument_Category'];
    public $timestamps = false;
}
