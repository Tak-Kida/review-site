<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Chapter extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        // バリデーション
    );

    // チャプターと書籍
    public function book() {
        return $this->hasOne('App\Models\Book', 'id', 'book_id');
    }
}
