<?php

namespace Modules\Movie\Entities;

use Modules\Movie\Entities\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Movie\Database\factories\CategoryFactory::new();
    }

    public function movies() {
        return $this->hasMany(Movie::class);
    }
}
