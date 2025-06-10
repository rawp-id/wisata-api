<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at', 'path'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->path ? asset('images/' . $this->path) : null;
    }
}
