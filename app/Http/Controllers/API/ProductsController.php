<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
            'name' => 'required|min:3|max:30',
            'image' => 'required|image|mimes:png,jpg',
            'content' => 'required|max:500',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);


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

        return Product::create([
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
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
        // $request->validate([
        //     'name' => 'required|min:3|max:30',
        //     'image' => 'nullable|image|mimes:png,jpg',
        //     'content' => 'required|max:500',
        //     'price' => 'required',
        //     'quantity' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        // ]);\

        // return $request->all();

        $data = $request->all();
        $product = Product::findOrFail($id);
        if($request->hasFile('image')) {
            File::delete(public_path('uploads/images/'.$product->image ));
            $imagename = 'product_'.time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/images'), $imagename);
            $data['image'] = $imagename;
        }

        $product->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Product::destroy($id);
    }
}
