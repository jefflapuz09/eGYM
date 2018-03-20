<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
use App\ProductBrand;
use App\ProductVariant;
use App\TypeBrand;
use App\TypeVariant;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Product::where('isActive',1)->get();
        return view('Product.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = ProductType::where('isActive',1)->get();
        $brand = ProductBrand::where('isActive',1)->get();
        $variant = ProductVariant::where('isActive',1)->get();
        return view('Product.create',compact('type','brand','variant'));
    }

    public function type($id)
    {
        $brands = TypeBrand::with('Brand')->where('typeId',$id)->get();
        $variant = TypeVariant::with('Variant')->where('typeId',$id)->get();
        return response()->json(['brands'=>$brands,'variant'=>$variant]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:products',
            'price' => 'required',
            'typeId' => 'required',
            'brandId' => 'required',
            'variantId' => 'required',
            'reorder' => 'required',
            'description' => 'nullable'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Product Name',
            'price' => 'Price',
            'typeId' => 'Product Type',
            'brandId' => 'Product Brand',
            'variantId' => 'Product Variant',
            'reorder' => 'Reorder Level',
            'description' => 'Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'typeId' => $request->typeId,
                'brandId' => $request->brandId,
                'variantId' => $request->variantId,
                'reorder' => $request->reorder,
                'description' => $request->description
            ]);
        }
        return redirect('/Product')->withSuccess('Successfully inserted into the database.');
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
        $type = ProductType::where('isActive',1)->get();
        $brand = ProductBrand::where('isActive',1)->get();
        $variant = ProductVariant::where('isActive',1)->get();
        $post = Product::find($id);
        return view('Product.update',compact('type','brand','variant','post'));
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
        $rules = [
            'name' => ['required',Rule::unique('products')->ignore($id)],
            'price' => 'required',
            'typeId' => 'required',
            'brandId' => 'required',
            'variantId' => 'required',
            'reorder' => 'required',
            'description' => 'nullable'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Product Name',
            'price' => 'Price',
            'typeId' => 'Product Type',
            'brandId' => 'Product Brand',
            'variantId' => 'Product Variant',
            'reorder' => 'Reorder Level',
            'description' => 'Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            Product::find($id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'typeId' => $request->typeId,
                'brandId' => $request->brandId,
                'variantId' => $request->variantId,
                'reorder' => $request->reorder,
                'description' => $request->description
            ]);
        }
        return redirect('/Product')->withSuccess('Successfully updated into the database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Product::find($id)->update(['isActive' => 0]);
            return redirect('/Product');    
    }

    public function soft()
    {
        $post = Product::where('isActive',0)->get();
        return view('Product.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Product::find($id)->update(['isActive' => 1]);
        return redirect('/Product');
    }

    public function remove($id)
    {
        $post = Product::find($id);
        $post->delete();
        return redirect('/Product/Soft');
    }
}
