<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Mail\InvoiceMail;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index()
    {
        $best_discount = Product::whereNotNull('discount')->orderBy('discount', 'desc')->first();

        $categories = Category::all();

        $latest_categories = Category::latest('id')->take(5)->get();
        // dd($latest_categories);

        // dd($best_discount);
        return view('front.index', compact('best_discount', 'categories', 'latest_categories'));
    }

    public function shop()
    {
        $products = Product::paginate(6);
        return view('front.shop', compact('products'));
    }

    public function shop_details($slug)
    {
        $product = Product::where('slug', $slug)->first();

        $related = Product::where('category_id', $product->category_id)->where('id', '<>', $product->id)->take(4)->get();

        return view('front.shop_details', compact('product', 'related'));
    }

    public function category_single($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = $category->products()->paginate(6);

        return view('front.shop',compact('products'));
    }

    public function blog()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(6);
        // dd($blogs);
        return view('front.blog', compact('blogs'));
    }

    public function blog_single($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        // dd($blog->category_id);

        $related = Blog::where('category_id', $blog->category_id)->where('id', '<>', $blog->id)->take(3)->get();

        // dd($related);

        return view('front.blog_single', compact('blog', 'related'));
    }

    public function add_comment()
    {
        Comment::create([
            'comment' => request()->comment,
            'blog_id' => request()->blog_id,
            'user_id' => Auth::id()
        ]);

        $comments = Blog::find(request()->blog_id)->comments()->orderBy('id', 'desc')->get();

        return view('front.parts.comment_list',compact('comments'))->render();
    }

    public function delete_comment($id)
    {

        $comment = Comment::findOrFail($id);

        if ($comment->user_id == Auth::id()){
            $comment->delete();
        }else {
            return 'بلاش هبل !!';
        }

        return redirect()->back();
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactus(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        Mail::to('admin@mohamed.com')->send(new ContactUsMail($request->except('_token')));

        return redirect()->back();
    }

    public function purchase_product(Request $request, $id)
    {
        // dd($request->all());

        $product = Product::find($id);

        $cart = Cart::where('user_id', Auth::id())->whereNull('order_id')->where('product_id', $id)->first();

        // dd($cart);

        if($cart) {
            $cart->update(['quantity' => $cart->quantity + $request->quantity]);
        }else {
            Cart::create([
                'price' => $product->price,
                'quantity' => $request->quantity,
                'user_id' => Auth::id(),
                'product_id' => $id
            ]);
        }



        return redirect()->route('site.checkout');

        // dd($product);
    }


    public function cart()
    {
        $carts = Cart::where('user_id', Auth::id())->whereNull('order_id')->get();
        return view('front.cart', compact('carts'));
    }

    public function delete_product($id)
    {
        Cart::destroy($id);
        return redirect()->back();
    }

    public function update_cart()
    {
        $items  = request()->items;

        foreach($items as $item) {
            $new_qty = $item[0];
            $p_id = $item[1];

            Cart::where('product_id', $p_id)->where('user_id', Auth::id())->update([
                'quantity' => $new_qty
            ]);
        }

        $carts = Cart::where('user_id', Auth::id())->whereNull('order_id')->get();

        return view('front.parts.cart_items', compact('carts'))->render();
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::id())->whereNull('order_id')->get();

        $amount = 0;
        foreach ($carts as $cart):
            $amount += $cart->quantity * $cart->price;
        endforeach;

        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=$amount" .
                    "&currency=USD" .
                    "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $responseData = json_decode($responseData, true);
            // return $responseData;
        $checkoutId = $responseData['id'];

        // dd($responseData);

        return view('front.checkout', compact('carts', 'checkoutId'));
    }

    public function thanks()
    {
        $carts = Cart::where('user_id', Auth::id())->whereNull('order_id')->get();

        $amount = 0;
        foreach ($carts as $cart):
            $amount += $cart->quantity * $cart->price;
        endforeach;

        // dd(request()->all());
        $resourcePath = request()->resourcePath;

        $url = "https://eu-test.oppwa.com/$resourcePath";
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData = json_decode($responseData, true);
        // dd($responseData['result']['code']);

        if($responseData['result']['code'] == '000.100.110') {

            $order = Order::create(['total' => $amount, 'user_id' => Auth::id()]);

            Payment::create([
                'total' => $amount,
                'user_id' => Auth::id(),
                'tranaction_id' => $responseData['id'],
                'order_id' => $order->id
            ]);

            Cart::where('user_id', Auth::id())->whereNull('order_id')->update(['order_id' => $order->id]);

            // send invoice to the user

            // return PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');

            $inv_name = 'invoice_'.rand().rand().'.pdf';

            $pdf = PDF::loadView('front.invoice', ['carts' => $carts, 'order' => $order])->save(public_path('invoices/') . $inv_name);


            // Storage::put('public/invoices/'.$inv_name, $pdf->output());

            Mail::to(Auth::user())->send(new InvoiceMail($order, $inv_name));

            return redirect()->route('site.home')->with('msg', 'Payment Done Successfully')->with('type', 'success');

        }else {
            return redirect()->route('site.home')->with('msg', 'Payment Faild')->with('type', 'danger');
        }
    }

}
