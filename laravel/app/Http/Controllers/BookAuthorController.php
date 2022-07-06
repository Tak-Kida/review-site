<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookAuthor;

class BookAuthorController extends Controller
{
    // 書籍に紐づく著者を登録する
    public function create($book_id, $array)
    {
        foreach($array as $value) {
            $book_author = new BookAuthor;
            $book_author->fill([
                'book_id' => $book_id,
                'author_id' => $value,
            ])->save();
        }
    }
}
