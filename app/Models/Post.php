<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = []; // Allow Mass Assignment for all field. !! Watch Out !!
    // protected $guarded = ["id"]; // Guard id column and allow the rest
    // protected $fillable = ["title", "slug", "excerpt", "body"];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
