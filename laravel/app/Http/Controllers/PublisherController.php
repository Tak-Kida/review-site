<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publisher;

class PublisherController extends Controller
{
    // 一覧画面
    public function index()
    {
        $publishers = Publisher::all();
        $data = ['publishers' => $publishers];
        return view('publishers.index', $data);
    }

    // 新規登録画面の表示
    public function register()
    {
        $data = [];
        return view('publishers.register', $data);
    }

    // 新規登録を行う
    public function create(Request $request)
    {
        $this->validate($request, Publisher::$rules);
        $publisher = new Publisher;
        $form = $request->all();
        unset($form['_token']);
        $publisher->fill($form)->save();
        return redirect('/publisher/index');
    }

    // 編集画面
    public function edit(Request $request)
    {
        $publisher = Publisher::where('id', $request->id)->first();
        $data = ['publisher' => $publisher];
        return view('publishers.edit', $data);
    }

    // 更新を行う
    public function update(Request $request)
    {
        $this->validate($request, Publisher::$rules);
        $publisher = Publisher::where('id', $request->id)->first();
        $form = $request->all();
        unset($form['_token']);
        $publisher->fill($form)->save();
        return redirect('/publisher/index');
    }

    // 削除を行う
    public function delete(Request $request)
    {
        $publisher = Publisher::where('id', $request->id)->first();
        $publisher->deleted_flg= 1;
        $publisher->deleted_at = date("Y-m-d H:i:s");
        $publisher->save();
        return redirect('/publisher/index');
    }
}
