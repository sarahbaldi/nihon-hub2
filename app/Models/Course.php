<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','poster','room_id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
        
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
        
    }
}
