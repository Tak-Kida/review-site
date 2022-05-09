<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Chapter;

class ChapterController extends Controller
{
    // 新規登録を行う
    public function create(Request $request)
    {
        $this->validate($request, Chapter::$rules);
        $chapter = new Chapter;
        $form = $request->all();
        unset($form['_token']);
        $chapter->fill($form)->save();
        return redirect('/book/detail/' . $request->book_id);
    }

    // 編集画面
    public function edit(Request $request)
    {
        $chapter = Chapter::where('id', $request->id)->first();
        $data = ['chapter' => $chapter];
        return view('chapters.edit', $data);
    }

    // 更新を行う
    public function update(Request $request)
    {
        $this->validate($request, Chapter::$rules);
        $chapter = Chapter::where('id', $request->id)->first();
        $form = $request->all();
        unset($form['_token']);
        $chapter->fill($form)->save();
        return redirect('/book/detail/' . $chapter->book_id );
    }

    // 削除を行う
    public function delete(Request $request)
    {
        $chapter = Chapter::where('id', $request->id)->first();
        $chapter->deleted_flg= 1;
        $chapter->deleted_at = date("Y-m-d H:i:s");
        $chapter->save();
        return redirect('/book/detail/' . $chapter->book_id );
    }
}
