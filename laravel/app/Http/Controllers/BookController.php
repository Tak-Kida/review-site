<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Author;
use App\Models\BookAuthor;

class BookController extends Controller
{
    // 一覧をJSONで取得する
    public function getIndex()
    {
        $books = Book::with('publisher', 'book_authors.author')->get();
        return $books->toJson();
    }

    // 新しく登録された順に５冊の書籍情報をJSONで取得する
    public function getLatest()
    {
        $books = Book::where('deleted_flg', '0')
                    ->with('publisher', 'book_authors.author')
                    ->orderBy('id', 'desc')
                    ->take(5)
                    ->get();
        return $books->toJson();
    }

    // 詳細をJSONで取得する
    public function getDetail(Request $request)
    {
        $book = Book::where('deleted_flg', '0')
                    ->where('id', $request->id)
                    ->with('publisher', 'book_authors.author')->first();
        return $book->toJson();
    }

    // 新規登録を行う
    public function create(Request $request)
    {
        // 書籍情報の保存
        $form = $request->all();
        // 新規の出版社が入力されていたら登録する
        if ($form['publisher_name'] && $form['publisher_name_furigana']) {
            $validated = $request->validate([
                // 'publisher_name'          => 'required|unique:posts|max:255',
                // 'publisher_name_furigana' => 'required',
            ]);
            $publisher = app()->make('App\Http\Controllers\PublisherController');
            $publisher_id = $publisher->register($form['publisher_name'], $form['publisher_name_furigana']);
            $form['publisher_id'] = $publisher_id;
        }
        // 新規の著者が入力されていたら登録する
        if ($form['author_new_name'] && $form['author_new_name_furigana']) {
            foreach($form['author_new_name'] as $key => $author_new_name_one) {
                $validated = $request->validate([
                    // 'publisher_name'          => 'required|unique:posts|max:255',
                    // 'publisher_name_furigana' => 'required',
                ]);
                $author = app()->make('App\Http\Controllers\AuthorController');
                $author_id = $author->register($author_new_name_one, $form['author_new_name_furigana'][$key]);
                // 既存の登録者が選択されていない場合実行する
                if(!isset($form['authors'])){
                    $form = array_merge($form,array('authors'=>[]));
                }
                array_push($form['authors'], $author_id);
            }
        }
        $this->validate($request, Book::$rules);
        $book = new Book;
        if($request->file('book_image')) {
            $image_name =  time() . (string)mt_rand(0, 99999) . '.png';
            $form['image_name'] = $image_name;
        }
        unset($form['_token']);
        $book->fill($form)->save();

        // 書籍画像の保存
        $dir = 'book_image'; // ディレクトリ名
        // 画像を保存する
        if($request->file('book_image')) {
            $image_file = $request->file('book_image');
            $image_file->storeAs('public/' . $dir, $image_name);
        }

        // 書籍と著者の紐付けレコードの保存
        $book_author = app()->make('App\Http\Controllers\BookAuthorController');
        $book_author->create($book->id, $form['authors']);
        return redirect('/book');
    }

    // 更新を行う
    public function update(Request $request)
    {
        // dd($request);
        $form = $request->all();

        // 新規の出版社が入力されていたら登録する
        if ($form['publisher_name'] && $form['publisher_name_furigana']) {
            $validated = $request->validate([
                // 'publisher_name'          => 'required|unique:posts|max:255',
                // 'publisher_name_furigana' => 'required',
            ]);
            $publisher = app()->make('App\Http\Controllers\PublisherController');
            $publisher_id = $publisher->register($form['publisher_name'], $form['publisher_name_furigana']);
            $form['publisher_id'] = $publisher_id;
        }

        // ToDo
        // 新規著者情報の空欄チェック
        // 新規の著者が入力されていたら登録する
        // if ($form['author_new_name'] && $form['author_new_name_furigana']) {
        //     foreach($form['author_new_name'] as $key => $author_new_name_one) {
        //         $validated = $request->validate([
        //             // 'publisher_name'          => 'required|unique:posts|max:255',
        //             // 'publisher_name_furigana' => 'required',
        //         ]);
        //         $author = app()->make('App\Http\Controllers\AuthorController');
        //         $author_id = $author->register($author_new_name_one, $form['author_new_name_furigana'][$key]);
        //         array_push($form['authors'], $author_id);
        //     }
        // }

        // 書籍をまず更新する
        $this->validate($request, Book::$rules);
        $book = Book::where('id', $request->id)->first();
        if($request->file('book_image')) {
            $image_name =  time() . (string)mt_rand(0, 99999) . '.png';
            $form['image_name'] = $image_name;
        }
        unset($form['_token']);
        $book->fill($form)->save();

        // 書籍画像の保存
        $dir = 'book_image'; // ディレクトリ名
        // 画像を保存する
        if($request->file('book_image')) {
            $image_file = $request->file('book_image');
            $image_file->storeAs('public/' . $dir, $image_name);
        }

        // 書籍の著者情報を更新する
        $book_author = app()->make('App\Http\Controllers\BookAuthorController');
        $book_author->update($book->id, $form['authors']);
        return redirect('/book/detail/' . $book->id);
    }

    // 削除を行う
    public function delete(Request $request)
    {
        $book = Book::where('id', $request->id)->first();
        $book->deleted_flg= 1;
        $book->deleted_at = date("Y-m-d H:i:s");
        $book->save();
        return redirect('/book');
    }
}
