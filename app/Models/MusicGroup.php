<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicGroup extends Model
{
    use HasFactory;

    protected $table = 'music_groups';
    
    protected $primaryKey = 'Group_ID';
    
    protected $fillable = ['Name','Media_group_ID', 'Genre_ID', 'Group_composition', 'Description'];

    public $timestamps = false; 

    public function media()
    {
        return $this->belongsTo(MediaGroup::class, 'Media_group_ID', 'Media_group_ID');
    }
}

