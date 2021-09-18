<?php

namespace Modules\Movie\Entities;

use Modules\Movie\Entities\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rate',
        'date',
        'duration',
        'country',
        'category_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Movie\Database\factories\MovieFactory::new();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
