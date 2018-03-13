<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
use App\TypeBrand;
use App\ProductBrand;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class pTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = ProductType::where('isActive',1)->get();
        return view('ProductType.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ProductType.create');
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
            'name' => ['required','unique:product_types','max:50','regex:/^[^~`!@#*_={}|\;<>,.?]+$/'],
            'brands.*' => ['required','distinct','max:50','regex:/^[^~`!@#*_={}|\;<>,.?]+$/'],
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Product Type',
            'brands.*' => 'Brand'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $type = ProductType::create([
                'name' => $request->name
            ]);
    
            foreach($request->brands as $brand)
            {
                ProductBrand::create([
                    'name' => $brand
                ]);
                $brandId = ProductBrand::where('name',$brand)->first();
                TypeBrand::create([
                    'typeId' => $type->id,
                    'brandId' => $brandId->id
                ]);
            }
        }
        return redirect('/ProductType')->withSuccess('Successfully inserted into the database.');
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
        $post = ProductType::find($id);
        return view('ProductType.update',compact('post'));
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
            'name' => ['required',Rule::unique('product_types')->ignore($id),'regex:/^[^~`!@#*_={}|\;<>,.?]+$/'],
            'brands.*' => ['required','distinct','max:50','regex:/^[^~`!@#*_={}|\;<>,.?]+$/'],
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Product Type',
            'brands.*' => 'Brand'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $type = ProductType::find($id)->update([
                'name' => $request->name
            ]);

            $chkType = TypeBrand::where('typeId',$id)->delete();
            foreach($request->brands as $brand)
            {
                ProductBrand::create([
                    'name' => $brand
                ]);
                $brandId = ProductBrand::where('name',$brand)->first();
                TypeBrand::create([
                    'typeId' => $id,
                    'brandId' => $brandId->id
                ]);
            }
        }
        return redirect('/ProductType')->withSuccess('Successfully updated into the database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        ProductType::find($id)->update(['isActive' => 0]);
            return redirect('/ProductType');    
    }

    public function soft()
    {
        $post = ProductType::where('isActive',0)->get();
        return view('ProductType.soft',compact('post'));
    }

    public function reactivate($id)
    {
        ProductType::find($id)->update(['isActive' => 1]);
        return redirect('/ProductType');
    }

    public function remove($id)
    {
        $chkTypeBrand = TypeBrand::where('typeId',$id)->get();
        if(count($chkTypeBrand)!=0)
        {
            return Redirect::back()->withError('It seems the product type are being used in the other items.');
        }
        else
        {
            $post = ProductType::find($id);
            $post->delete();
        }
        return redirect('/ProductType/Soft');
    }
}
