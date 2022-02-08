<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function shop()
    {
        $products = Product::paginate(6);
        return view('front.shop', compact('products'));
    }

    public function shop_details($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('front.shop_details', compact('product'));
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
}
