<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;

    protected $table = 'book_author';

    protected $guarded = array('id');

    public function author() {
        return $this->hasOne('App\Models\Author', 'id', 'author_id');
    }
}
