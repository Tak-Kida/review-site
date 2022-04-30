<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // 一覧画面
    public function index()
    {
        $books = Book::all();
        $data = ['books' => $books];
        return view('books.index', $data);
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
        $data = [];
        return view('books.register', $data);
    }

    // 更新を行う
    public function update(Request $request)
    {
        $data = [];
        return view('books.register', $data);
    }

    // 削除を行う
    public function deete(Request $request)
    {
        $data = [];
        return view('books.register', $data);
    }
}
