<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductBrand;
use App\ProductType;
use App\TypeBrand;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class pBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = ProductBrand::where('isActive',1)->get();
        return view('ProductBrand.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pType = ProductType::where('isActive',1)->get();
        return view('ProductBrand.create',compact('pType'));
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
            'name' => ['required','unique:product_brands','max:50','regex:/^[^~`!@#*_={}|\;<>,.?]+$/'],
            'types.*' => ['required','distinct','max:50','regex:/^[^~`!@#*_={}|\;<>,.?]+$/'],
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Product Brand',
            'types.*' => 'Type'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $brand = ProductBrand::create([
                'name' => $request->name
            ]);
    
            foreach($request->types as $type)
            {
                $typeId = ProductType::where('name',$type)->first();
                TypeBrand::create([
                    'typeId' => $typeId->id,
                    'brandId' => $brand->id
                ]);
            }
        }
        return redirect('/ProductBrand')->withSuccess('Successfully inserted into the database.');
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
        $post = ProductBrand::find($id);
        $pType = ProductType::where('isActive',1)->get();
        return view('ProductBrand.update',compact('post','pType'));
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
            'name' => ['required',Rule::unique('product_brands')->ignore($id),'max:50','regex:/^[^~`!@#*_={}|\;<>,.?]+$/'],
            'types.*' => ['required','distinct','max:50','regex:/^[^~`!@#*_={}|\;<>,.?]+$/'],
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Product Brand',
            'types.*' => 'Type'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $brand = ProductBrand::find($id)->update([
                'name' => $request->name
            ]);

            TypeBrand::where('brandId',$id)->delete();
            foreach($request->types as $type)
            {
                $typeId = ProductType::where('name',$type)->first();
                TypeBrand::create([
                    'typeId' => $typeId->id,
                    'brandId' => $id
                ]);
            }
        }
        return redirect('/ProductBrand')->withSuccess('Successfully updated into the database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        ProductBrand::find($id)->update(['isActive' => 0]);
            return redirect('/ProductBrand');    
    }

    public function soft()
    {
        $post = ProductBrand::where('isActive',0)->get();
        return view('ProductBrand.soft',compact('post'));
    }

    public function reactivate($id)
    {
        ProductBrand::find($id)->update(['isActive' => 1]);
        return redirect('/ProductBrand');
    }

    public function remove($id)
    {
        $chkTypeBrand = TypeBrand::where('brandId',$id)->get();
        if(count($chkTypeBrand)!=0)
        {
            return Redirect::back()->withError('It seems the product type are being used in the other items.');
        }
        else
        {
            $post = ProductBrand::find($id);
            $post->delete();
        }
        return redirect('/ProductBrand/Soft');
    }
}
