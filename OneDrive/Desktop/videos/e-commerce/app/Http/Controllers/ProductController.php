<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    //
    public function index()
    {
        $rowFromDB = Product::all();
        return view('welcome', ['products' => $rowFromDB]);
    }

    public function show()
    {
        $rowFromDB = Product::all();
        return view('shop', ['products' => $rowFromDB]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function about()
    {
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
                "image" => $product->image,
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
    public function send(Request $request)
    {
        Log::info('Contact form submission started');
        set_time_limit(300);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Log::info('Validation passed');

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Log::info('Details prepared', $details);

        Mail::to('your-email@example.com')->send(new ContactFormMail($details)); // Replace with your email address

        Log::info('Email sent');

        return back()->with('success', 'Thanks for contacting us!');
    }
}
