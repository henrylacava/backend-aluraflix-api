<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['title','description','url','category_id'];
    protected $attributes = ['category_id' => 1];

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
