<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaGroup extends Model
{
    protected $table = 'media_groups';
    protected $primaryKey = 'Media_group_ID';
    protected $fillable = ['Media_file', 'Video_File'];
    public $timestamps = false;
}
