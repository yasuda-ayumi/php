<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('category');

        // 名前＋メール（部分一致）
if ($request->filled('keyword')) {
    $keyword = $request->keyword;

    $query->where(function ($q) use ($keyword) {
        $q->where('first_name', 'like', "%{$keyword}%")
          ->orWhere('last_name', 'like', "%{$keyword}%")
          ->orWhereRaw("CONCAT(last_name,first_name) LIKE ?", ["%{$keyword}%"])
          ->orWhereRaw("CONCAT(last_name,' ',first_name) LIKE ?", ["%{$keyword}%"])
          ->orWhere('email', 'like', "%{$keyword}%"); // ← 追加
    });
}

        

        // 性別
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // カテゴリ
        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $query->where('category_id', $request->category_id);
        }

        // 日付
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7)->withQueryString();
        $categories = Category::all();

        return view('admin.index', compact('contacts','categories'));
    }

    // 削除
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.index');
    }

    // 検索連動CSV
    // 検索連動CSV（完全一致版）
public function export(Request $request)
{
    $query = Contact::with('category');

    // 🔍 keyword（名前＋メール）
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;

        $query->where(function ($q) use ($keyword) {
            $q->where('first_name','like',"%{$keyword}%")
              ->orWhere('last_name','like',"%{$keyword}%")
              ->orWhereRaw("CONCAT(last_name,first_name) LIKE ?", ["%{$keyword}%"])
              ->orWhereRaw("CONCAT(last_name,' ',first_name) LIKE ?", ["%{$keyword}%"])
              ->orWhere('email','like',"%{$keyword}%");
        });
    }

    // 🔍 性別
    if ($request->filled('gender') && $request->gender !== 'all') {
        $query->where('gender', $request->gender);
    }

    // 🔍 カテゴリ
    if ($request->filled('category_id') && $request->category_id !== 'all') {
        $query->where('category_id', $request->category_id);
    }

    // 🔍 日付
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->get();

    return response()->streamDownload(function () use ($contacts) {

        $handle = fopen('php://output','w');
        fputcsv($handle,['名前','性別','メール','電話','住所','建物','種類','内容']);

        foreach($contacts as $c){
            fputcsv($handle,[
                $c->last_name.' '.$c->first_name,
                $c->gender == 1 ? '男性' : ($c->gender == 2 ? '女性' : 'その他'),
                $c->email,
                $c->tel1.'-'.$c->tel2.'-'.$c->tel3, // ← 電話修正
                $c->address,
                $c->building,
                $c->category->content,
                $c->detail
            ]);
        }

        fclose($handle);

    },'contacts.csv');
}
}