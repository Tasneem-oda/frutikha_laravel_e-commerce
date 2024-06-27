<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\product;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    //
    public function index(){
        $rowFromDB = Product::all();
        return view('welcome',['products'=>$rowFromDB]);
    }
    public function show(){
        $rowFromDB  = Product::all();
        return view('shop',['products'=>$rowFromDB]);
    }
    public function contact(){
        return view('contact');
    }
    public function about(){
        return view('about');
    }
    // public function cart_(){
    //     return view('cart');
    // }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image ,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['cart' => $cart]);
    }
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return response()->json(['cart' => $cart]);
    }
    public function store(Request $request){
        $request->validate([
            'name'=> 'required|string|max:100',
            'email' => 'required|string|max:100',
            'message'=> 'required|string',
            'phone' => 'required|string',
            'subject' => 'required|string'
        ]);
        $details = [
            'name' => $request->name,
            'email' => $request->email, 
            'message' => $request->message,
            'phone' => $request->phone,
            'subject' => $request->subject,
        ];
        Mail::to ('tasneemahmed2112005@gmail.com')->send(new ContactFormMail($details['name'],$details['email'],$details['message'],$details['phone'],$details['subject']));
        return response()->json(['message' => 'Contact form submitted successfully.'], 200);
    }
    
}
