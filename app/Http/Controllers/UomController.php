<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Uom;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class UomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Uom::where('isActive',1)->get();
        return view('UOM.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('UOM.create');
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
            'name' => ['required'],
            'category' => 'required',
            'description' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Unit of Measurement',
            'category' => 'Category',
            'description' => 'Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            Uom::create([
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description
            ]);
        }
        return redirect('/UnitMeasurement')->withSuccess('Successfully inserted into the database.');
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
        $post = Uom::find($id);
        return view('UOM.update',compact('post'));
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
            'name' => ['required'],
            'category' => 'required',
            'description' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.',
            'regex' => 'The :attribute must not contain special characters.'              
        ];
        $niceNames = [
            'name' => 'Unit of Measurement',
            'category' => 'Category',
            'description' => 'Description'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            Uom::find($id)->update([
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description
            ]);
        }
        return redirect('/UnitMeasurement')->withSuccess('Successfully updated into the database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Uom::find($id)->update(['isActive' => 0]);
            return redirect('/UnitMeasurement');    
    }

    public function soft()
    {
        $post = Uom::where('isActive',0)->get();
        return view('UOM.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Uom::find($id)->update(['isActive' => 1]);
        return redirect('/UnitMeasurement');
    }

    public function remove($id)
    {
        $post = Uom::find($id);
        $post->delete();
        return redirect('/UnitMeasurement/Soft');
    }
}
