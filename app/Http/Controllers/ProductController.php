<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('id', 'desc')->paginate(10);
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'price' => 'numeric|min:0',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $p = Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'advance' => $request->advance,
            'duration' => $request->duration,
            'description' => $request->description,
        ]);

        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $image)
            {
                $filename = uniqid().time().'.'.'jpg';
                $image->move('assets/images/product', $filename);
                $data = $filename;
                ProductImage::create([
                    'product_id' => $p->id,
                    'image' => $data,
                ]);
            }

        }
        return back()->withMsg('Successfully Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product_ = Product::findOrFail($product->id);
        return view('admin.product.edit', compact('product_'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'price' => 'numeric|min:0',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        Product::whereId($request->id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'advance' => $request->advance,
                'duration' => $request->duration
            ]);

        if($request->hasfile('image'))
        {
            for ($i = 0; $i < count($request->image_id); $i++)
            {

                $image = $request->file('image');
                if ($request->image_id[$i] == null){
                    $filename = uniqid().time().'.'.'jpg';
                    $image[$i]->move('assets/images/product', $filename);
                    $data[$i] = $filename;
                    ProductImage::updateOrCreate(['id' => $request->image_id[$i],],
                        [
                            'image' => $data[$i],
                            'product_id' => $request->id
                        ]);
                }

            }

        }

        return redirect('admin/product')->withMsg('Successfully Update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $p = ProductImage::where('product_id',$product->id)->get();
        foreach ($p as $d){
            @unlink('assets/images/product/'.$d->image);
            $d->delete();
        }
        $product->delete();
        return back()->withMsg('Successfully Delete');
    }


}
