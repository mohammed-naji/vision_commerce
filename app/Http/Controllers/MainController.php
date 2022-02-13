<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $cart = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

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



        return redirect()->back();

        // dd($product);
    }


    public function cart()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('front.cart', compact('carts'));
    }

    public function delete_product($id)
    {
        Cart::destroy($id);
        return redirect()->back();
    }

    public function update_cart()
    {
        return request()->all();
    }

}
