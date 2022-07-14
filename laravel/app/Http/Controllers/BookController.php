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
        $books = Book::all();
        return $books->toJson();
    }

    // 詳細をJSONで取得する
    public function getDetail(Request $request)
    {
        $book = Book::where('id', $request->id)
            ->with('publisher', 'book_authors.author')->first();
        return $book->toJson();
    }

    // 一覧画面
    // public function index()
    // {
    //     $books = Book::all();
    //     $data = ['books' => $books];
    //     // return view('books.index', $data);
    //     return view('app', $data);
    // }

    // 詳細画面
    // public function detail(Request $request)
    // {
    //     $book = Book::where('id', $request->id)->first();
    //     $chapters = Chapter::where('book_id', $request->id)->get();
    //     $author = Author::where('id', $book->author_id)->first();
    //     $data = [
    //         'book' => $book,
    //         'chapters' => $chapters,
    //         'author' => $author,
    //         'publisher' => $publisher,
    //     ];
    //     // return view('books.detail', $data);
    //     return view('app', $data);
    // }

    // 新規登録画面の表示
    // public function register()
    // {
    //     $data = [];
    //     return view('books.register', $data);
    // }

    // 新規登録を行う
    public function create(Request $request)
    {
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
                array_push($form['authors'], $author_id);
            }
        }
        $this->validate($request, Book::$rules);
        $book = new Book;
        unset($form['_token']);
        $book->fill($form)->save();
        $book_author = app()->make('App\Http\Controllers\BookAuthorController');
        $book_author->create($book->id, $form['authors']);
        return redirect('/book');
    }

    // 編集画面
    public function edit(Request $request)
    {
        // $book = Book::where('id', $request->id)->first();
        // $data = ['book' => $book];
        // // return view('books.edit', $data);
        // return view('app', $data);
    }

    // 更新を行う
    public function update(Request $request)
    {
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
        unset($form['_token']);
        $book->fill($form)->save();
        // 書籍の著者情報を更新する
        $book_author = app()->make('App\Http\Controllers\BookAuthorController');
        $book_author->update($book->id, $form['authors']);
        return redirect('/book');
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
