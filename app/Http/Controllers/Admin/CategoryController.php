<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->has('search')) {
            $categories = Category::where('name', 'like', '%' . request()->search . '%')->latest()->paginate(5);
        }else {
            $categories = Category::latest()->paginate(5);
        }


        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
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
            'name_en' => 'required|min:3|max:30',
            'name_ar' => 'required|min:3|max:30',
            'image' => 'required|image|mimes:png,jpg',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        // upload image
        $imgname = 'category_'.rand().time(). $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $imgname);

        Category::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'slug' => Str::slug($request->name_en),
            'image' => $imgname,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('admin.categories.index')->with('msg', 'Category added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Showwwwwww';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories'));
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
            'name_en' => 'required|min:3|max:30',
            'name_ar' => 'required|min:3|max:30',
            'image' => 'nullable|image|mimes:png,jpg',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $category = Category::findOrFail($id);

        $imgname = $category->image;

        if($request->hasFile('image')) {
            $imgname = 'category_'.rand().time(). $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imgname);
        }

        $category->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'image' => $imgname,
            'slug' => Str::slug($request->name_en),
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('admin.categories.index')->with('msg', 'Category updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        // Category::where('parent_id', $id)->update([
        //     'parent_id' => null
        // ]);

        Category::where('parent_id', $id)->delete();

        return redirect()->route('admin.categories.index')->with('msg', 'Category deleted successfully')->with('type', 'danger');
    }
}
