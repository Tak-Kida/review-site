<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookAuthor;

class BookAuthorController extends Controller
{
    // 書籍に紐づく著者一覧をJSONで取得する
    public function getIndex(Request $request)
    {
        $book_authors = BookAuthor::where('book_id', $request->book_id)->get();
        return $book_authors->toJson();
    }

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

    // 書籍に紐づく著者を削除する
    public function findAndRemove($book_id, $author_id)
    {
        $book_author = BookAuthor::where([
            ['book_id', '=', $book_id],
            ['author_id', '=', $author_id,]
        ])->first();
        $book_author->delete();
    }

    // 書籍に紐づく著者を更新する
    public function update($book_id, $new_authors)
    {
        // 今まで登録されていた著者を取得する
        $book_authors_old = BookAuthor::where('book_id', $book_id)->get();

        // 更新前の著者のidによる配列を作る
        $old_authors = [];
        foreach($book_authors_old as $book_author_old) {
            array_push($old_authors, $book_author_old->author_id);
        }

        // 送信された著者をもとに更新用の配列を作る
        foreach($new_authors as $new_author_id) {
            if(in_array($new_author_id, $old_authors)) {
                // new_authorsから要素を削除して、今まで登録されていなかった著者だけを残す
                $index = array_search($new_author_id, $new_authors);
                array_splice($new_authors, $index, 1);

                // old_authorsから要素を削除して、今後ひもづかない著者だけを残す
                $index = array_search($new_author_id, $old_authors);
                array_splice($old_authors, $index, 1);
            }
        }
        // old_authorsに残ったidの著者と書籍を紐付けるレコードを削除する
        foreach($old_authors as $old_author) {
            $this->findAndRemove($book_id, $old_author);
        }

        // new_authorsに残ったidの著者と書籍を紐付けるレコードを登録する
        $this->create($book_id, $new_authors);
    }
}
