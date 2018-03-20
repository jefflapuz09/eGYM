<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductVariant;
use App\Uom;
use App\TypeVariant;
use App\ProductType;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = ProductVariant::where('isActive',1)->get();
        return view('Variant.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        $post = Uom::where('category',$id)->get();
        return response()->json($post);
    }

    public function create()
    {
        $type = ProductType::where('isActive',1)->get();
        $post = Uom::where('category','Mass')->get();
        return view('Variant.create',compact('post','type'));
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
            'size' => 'required|unique:product_variants',
            'category' => 'required',
            'type' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'size' => 'Size',
            'category' => 'Category',
            'typeId' => 'Product Type'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            
            $size = $request->size.' '.$request->unit;
            $variant = ProductVariant::create([
                'size' => $size,
                'category' => $request->category
            ]);

            TypeVariant::create([
                'variantId' => $variant->id,
                'typeId' => $request->type
            ]);
        }
        return redirect('/ProductVariant')->withSuccess('Successfully inserted into the database.');
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
        $unit = Uom::where('category','Mass')->get();
        $post = ProductVariant::find($id);
        return view('Variant.update',compact('post','type','unit'));
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
            'size' => "required|Rule::unique('produt_variants')->ignore($id)",
            'category' => 'required',
            'type' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'size' => 'Size',
            'category' => 'Category',
            'typeId' => 'Product Type'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $size = $request->size.' '.$request->unit;
            ProductVariant::find($id)->update([
                'size' => $size,
                'category' => $request->category
            ]);

            TypeVariant::where('variantId',$id)->delete();
            TypeVariant::create([
                'variantId' => $id,
                'typeId' => $request->type
            ]);
        }
        return redirect('/ProductVariant')->withSuccess('Successfully updated into the database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        ProductVariant::find($id)->update(['isActive' => 0]);
            return redirect('/ProductVariant');    
    }

    public function soft()
    {
        $post = ProductVariant::where('isActive',0)->get();
        return view('Variant.soft',compact('post'));
    }

    public function reactivate($id)
    {
        ProductVariant::find($id)->update(['isActive' => 1]);
        return redirect('/ProductVariant');
    }

    public function remove($id)
    {
        TypeVariant::where('variantId',$id)->delete();
        ProductVariant::where('id',$id)->delete();
        return redirect('/ProductVariant/Soft');
    }
}
