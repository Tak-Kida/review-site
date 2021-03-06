<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Author;
use App\Models\Publisher;

class BookController extends Controller
{
    // 一覧画面
    public function index()
    {
        $books = Book::all();
        $data = ['books' => $books];
        return view('books.index', $data);
    }

    // 詳細画面
    public function detail(Request $request)
    {
        $book = Book::where('id', $request->id)->first();
        $chapters = Chapter::where('book_id', $request->id)->get();
        $author = Author::where('id', $book->author_id)->first();
        $publisher = Publisher::where('id', $book->publisher_id)->first();
        $data = [
            'book' => $book,
            'chapters' => $chapters,
            'author' => $author,
            'publisher' => $publisher,
        ];
        return view('books.detail', $data);
    }

    // 新規登録画面の表示
    public function register()
    {
        $data = [];
        return view('books.register', $data);
    }

    // 新規登録を行う
    public function create(Request $request)
    {
        $this->validate($request, Book::$rules);
        $book = new Book;
        $form = $request->all();
        unset($form['_token']);
        $book->fill($form)->save();
        return redirect('/book/index');
    }

    // 編集画面
    public function edit(Request $request)
    {
        $book = Book::where('id', $request->id)->first();
        $data = ['book' => $book];
        return view('books.edit', $data);
    }

    // 更新を行う
    public function update(Request $request)
    {
        $this->validate($request, Book::$rules);
        $book = Book::where('id', $request->id)->first();
        $form = $request->all();
        unset($form['_token']);
        $book->fill($form)->save();
        return redirect('/book/index');
    }

    // 削除を行う
    public function delete(Request $request)
    {
        $book = Book::where('id', $request->id)->first();
        $book->deleted_flg= 1;
        $book->deleted_at = date("Y-m-d H:i:s");
        $book->save();
        return redirect('/book/index');
    }
}
