<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publisher;

class PublisherController extends Controller
{
    // 一覧をJSONで取得する
    public function getIndex()
    {
        $publishers = Publisher::where('deleted_flg', '0')->get();

        return $publishers->toJson();
    }

    // 詳細をJSONで取得する
    public function getDetail(Request $request)
    {
        $publisher = Publisher::where('deleted_flg', '0')
                        ->where('id', $request->id)
                        ->first();
        return $publisher->toJson();
    }

    // 新規登録の実行
    public function register($name, $name_furigana)
    {
        $publisher = new Publisher;
        $publisher->fill([
            'name' => $name,
            'name_furigana' => $name_furigana,
        ])->save();
        return($publisher->id);
    }

    // 新規登録を行う
    public function create(Request $request)
    {
        $this->validate($request, Publisher::$rules);
        $form = $request->all();
        $this->register($form['name'], $form['name_furigana']);
        unset($form['_token']);
        return redirect('/publisher');
    }

    // 更新を行う
    public function update(Request $request)
    {
        $this->validate($request, Publisher::$rules);
        $publisher = Publisher::where('id', $request->id)->first();
        $form = $request->all();
        unset($form['_token']);
        $publisher->fill($form)->save();
        return redirect('/publisher');
    }

    // 削除を行う
    public function delete(Request $request)
    {
        $publisher = Publisher::where('id', $request->id)->first();
        $publisher->deleted_flg= 1;
        $publisher->deleted_at = date("Y-m-d H:i:s");
        $publisher->save();
        return redirect('/publisher');
    }
}
