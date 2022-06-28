<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        // バリデーション
    );

    public function Book() {
        return $this->belongsTo('App/Author');
    }
}
