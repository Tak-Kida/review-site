<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    // 一覧画面
    public function index()
    {
        $authors = Author::all();
        $data = ['authors' => $authors];
        return view('authors.index', $data);
    }

    // 新規登録画面の表示
    public function register()
    {
        $data = [];
        return view('authors.register', $data);
    }

    // 新規登録を行う
    public function create(Request $request)
    {
        $this->validate($request, Author::$rules);
        $book = new Author;
        $form = $request->all();
        unset($form['_token']);
        $book->fill($form)->save();
        return redirect('/author/index');
    }

    // 編集画面
    public function edit(Request $request)
    {
        $author = Author::where('id', $request->id)->first();
        $data = ['author' => $author];
        return view('authors.edit', $data);
    }

    // 更新を行う
    public function update(Request $request)
    {
        $this->validate($request, Author::$rules);
        $author = Author::where('id', $request->id)->first();
        $form = $request->all();
        unset($form['_token']);
        $author->fill($form)->save();
        return redirect('/author/index');
    }

    // 削除を行う
    public function delete(Request $request)
    {
        $author = Author::where('id', $request->id)->first();
        $author->deleted_flg= 1;
        $author->deleted_at = date("Y-m-d H:i:s");
        $author->save();
        return redirect('/author/index');
    }
}
