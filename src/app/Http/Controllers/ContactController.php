<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index(Request $request){
        $categories = Category::all();
        $contact = $request->session()->get('contact', []);
        return view('contact' , compact('categories', 'contact'));
    }

    public function confirm(ContactRequest $request){
        $contact = $request->only(['last_name' , 'first_name' , 'gender' , 'email' , 'tell1' , 'tell2', 'tell3' , 'address' , 'building' , 'category_id' , 'detail']);

        if (!$contact) {
        return redirect('/')->with('error', 'セッションが切れています。');
        }

        $categoryContent = Category::find($contact['category_id'])->content ?? '不明';
        $contact['category_content'] = $categoryContent;

        $request->session()->put('contact', $contact);
        return view('confirm' , compact('contact'));
    }

    public function thanks(){
        return view('thanks');
    }


    public function store(Request $request){
        $genderMapping = [
        '男性' => 1,
        '女性' => 2,
        'その他' => 3,
    ];
        $contact = $request->session()->get('contact');

        $contact['tell'] = $contact['tell1'] . $contact['tell2'] . $contact['tell3'];
        $contact['gender'] = $genderMapping[$contact['gender']] ?? null;

        if (!$contact) {
        return redirect('/')->with('error', 'セッションが切れています。');
        }

        unset($contact['tell1'], $contact['tell2'], $contact['tell3']);

        Contact::create($contact);

        $request->session()->forget('contact');
        return redirect('thanks');
    }
}