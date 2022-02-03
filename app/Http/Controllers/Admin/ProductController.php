<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->has('search')) {
            $products = Product::where('name', 'like', '%' . request()->search . '%')->latest()->paginate(5);
        }else {
            $products = Product::latest()->paginate(5);
        }

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $discounts = Discount::all();

        return view('admin.products.create', compact('categories', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|min:3|max:30',
        //     'image' => 'required|image|mimes:png,jpg',
        //     'content' => 'required|max:500',
        //     'price' => 'required',
        //     'quantity' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        // ]);


        // upload image
        $imagename = 'product_'.time().'_'.$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/images'), $imagename);

        $album = [];
        if($request->hasFile('album')) {
            foreach($request->file('album') as $file) {
                $albumname = 'product_'.time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/images'), $albumname);
                $album[] = $albumname;
            }
        }

        $album = implode(',', $album);


        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagename,
            'album' => $album,
            'content' => $request->content,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with('msg', 'Product added successfully')->with('type', 'success');
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
        $categories = Category::all();
        $discounts = Discount::all();
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('categories', 'discounts', 'product'));
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
            'name' => 'required|min:3|max:30',
            'image' => 'nullable|image|mimes:png,jpg',
            'content' => 'required|max:500',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);

        $imagename = $product->image;

        if($request->hasFile('image')) {
            File::delete(public_path('uploads/images/'.$product->image ));
            // upload image
            $imagename = 'product_'.time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/images'), $imagename);
        }


        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagename,
            'content' => $request->content,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with('msg', 'Product added successfully')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        File::delete(public_path('uploads/images/'.$product->image ));

        $product->delete();

        return redirect()->route('admin.products.index')->with('msg', 'Product deleted successfully')->with('type', 'danger');
    }
}
