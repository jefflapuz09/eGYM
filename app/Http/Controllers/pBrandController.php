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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
