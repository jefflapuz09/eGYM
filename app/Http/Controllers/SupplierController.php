<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Supplier::where('isActive',1)->get();
        return view('Supplier.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Supplier.create');
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
            'name' => ['required','unique:suppliers'],
            'street' => 'nullable',
            'brgy' => 'nullable',
            'city' => 'required',
            'contactNumber' => 'required',
            'description' => 'nullable'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Supplier',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'contactNumber' => 'Contact Number',
            'description' => 'Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            Supplier::create($request->all());
        }
        return redirect('/Supplier')->withSuccess('Successfully inserted into the database.');
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
        $post = Supplier::find($id);
        return view('Supplier.update',compact('post'));
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
            'name' => ['required',Rule::unique('suppliers')->ignore($id)],
            'street' => 'nullable',
            'brgy' => 'nullable',
            'city' => 'required',
            'contactNumber' => 'required',
            'description' => 'nullable'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Supplier',
            'street' => 'Street',
            'brgy' => 'Brgy',
            'city' => 'City',
            'contactNumber' => 'Contact Number',
            'description' => 'Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            Supplier::find($id)->update($request->all());
        }
        return redirect('/Supplier')->withSuccess('Successfully updated into the database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Supplier::find($id)->update(['isActive' => 0]);
            return redirect('/Supplier');    
    }

    public function soft()
    {
        $post = Supplier::where('isActive',0)->get();
        return view('Supplier.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Supplier::find($id)->update(['isActive' => 1]);
        return redirect('/Supplier');
    }

    public function remove($id)
    {
        $post = Supplier::find($id);
        $post->delete();
        return redirect('/Supplier/Soft');
    }
}
