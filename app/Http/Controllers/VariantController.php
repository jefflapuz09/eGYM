<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductVariant;
use App\Uom;
use App\TypeVariant;
use App\ProductType;

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
        $variant = ProductVariant::create([
            'size' => $request->size,
            'unit' => $request->unit
        ]);

        TypeVariant::create([
            'variantId' => $variant->id,
            'typeId' => $request->type
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
