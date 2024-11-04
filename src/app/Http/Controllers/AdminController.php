<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Contact::query();
        $contacts = $query->paginate(7);

        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request){
        $contacts = Contact::with('category')
            ->KeywordSearch($request->keyword)
            ->GenderSearch($request->gender)
            ->CategorySearch($request->category_id)
            ->DateSearch($request->date)
            ->paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }


    public function exportCsv(Request $request){
        // 検索条件をクエリに適用して結果を取得
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'LIKE', "%{$keyword}%")
                ->orWhere('last_name', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $contacts = $query->get();

        $filename = "お問い合わせ.csv";

        // CSVデータを保持するための一時ストリームを作成
        $csvData = fopen('php://temp', 'r+');
        if ($csvData === false) {
            throw new \Exception("Failed to open temporary memory for CSV data.");
        }

        // UTF-8 BOMを追加
        fwrite($csvData, "\xEF\xBB\xBF");

        // ヘッダー行を追加
        fputcsv($csvData, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類'], ',', '"');

        // 各行のデータを追加
        foreach ($contacts as $contact) {
            fputcsv($csvData, [
                $contact->full_name,
                $contact->gender,
                $contact->email,
                $contact->category->content,
            ], ',', '"');
        }

        // ポインタを先頭に戻す
        rewind($csvData);

        // CSVデータを文字列として取得
        $output = stream_get_contents($csvData);

        // ストリームを閉じる
        fclose($csvData);

        // CSVレスポンスを返す
        return response($output, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$filename}",
        ])->setContent($output);
    }




    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.index')->with('success', 'お問い合わせを削除しました。');
    }
}
