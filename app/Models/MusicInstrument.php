<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicInstrument extends Model
{
    use HasFactory;

    protected $table = 'music_instruments';
    protected $primaryKey = 'Instrument_ID';
    protected $fillable = ['Sound_ID', 'Photo_ID', 'Tag_ID', 'Category_ID', 'Description'];
    public $timestamps = false;

        public function photo()
    {
        return $this->belongsTo(\App\Models\PhotoInstrument::class, 'Photo_ID', 'Photo_ID');
    }
}