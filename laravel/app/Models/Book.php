<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publisher;
use App\Models\Author;

class Book extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        // バリデーション
    );

    public function publisher() {
        return $this->hasOne('App\Models\Publisher', 'id', 'publisher_id');
    }

    public function book_authors() {
        return $this->hasMany('App\Models\BookAuthor', 'book_id', 'id');
    }

    // public function authors() {
    //     return $this->hasMany('App\Models\Author', 'id', 'author_id');
    // }
}
