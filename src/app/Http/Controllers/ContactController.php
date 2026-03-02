<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $data = $request->validated();
        $category = Category::findOrFail($data['category_id']);

        return view('confirm', compact('data', 'category'));
    }

    public function back(Request $request)
    {
        return redirect('/')
            ->withInput($request->all());
    }

    public function store(ContactRequest $request)
{
    $data = $request->validated();

    $tel = $data['tel1'] . $data['tel2']  . $data['tel3'];


    Contact::create([
        'last_name'   => $data['last_name'],
        'first_name'  => $data['first_name'],
        'gender'      => $data['gender'],
        'email'       => $data['email'],
        'tel'         => $tel,
        'address'     => $data['address'],
        'building'    => $data['building'] ?? null,
        'category_id' => $data['category_id'],
        'detail'      => $data['detail'],
    ]);

    return redirect()->route('contact.thanks')
                 ->with('success', true);
}
    public function thanks()
{
    if (!session('success')) {
        return redirect('/');
    }
    
    return view('thanks');
}
}
