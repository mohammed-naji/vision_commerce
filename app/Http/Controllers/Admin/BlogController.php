<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->has('search')) {
            $blogs = Blog::where('name', 'like', '%' . request()->search . '%')->latest()->paginate(5);
        }else {
            $blogs = Blog::latest()->paginate(5);
        }

        // dd($blogs);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'required',
            'category_id' => 'required',
        ]);

        $imagename = 'blog_'.time().'_'.$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads'), $imagename);

        Blog::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'content' => $request->content,
            'image' => $imagename,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.blogs.index')->with('msg', 'Blog added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);

        $categories = Category::all();

        return view('admin.blogs.edit', compact( 'categories', 'blog' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'nullable',
            'category_id' => 'required',
        ]);

        $blog = Blog::find($id);

        $imagename = $blog->image;

        if($request->hasFile('image')) {
            $imagename = 'blog_'.time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $imagename);
        }


        $blog->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'content' => $request->content,
            'image' => $imagename,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.blogs.index')->with('msg', 'Blog updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        File::delete(public_path('uploads/images/'.$blog->image ));

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('msg', 'Blog deleted successfully')->with('type', 'danger');
    }
}
