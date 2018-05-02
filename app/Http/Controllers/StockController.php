<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Product;
use App\Supplier;
use App\StockDelivery;
use App\StockDeliveryDetail;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Inventory::all();
        $prod = Product::where('isActive',1)->get();
        return view('Inventory.index',compact('post','prod'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receive()
    {
        $supplier = Supplier::where('isActive',1)->get();
        $product = Product::where('isActive',1)->get();
        return view('Inventory.create',compact('supplier','product'));
    }

    public function product($id)
    {
        $product = Product::with('Type')
            ->with('Brand')
            ->with('Variant')
            ->find($id);
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = StockDelivery::all()->count() + 1;
        $id = 'ORDER'.str_pad($id, 5, '0', STR_PAD_LEFT); 

        $index = 0;
        $index2 = 0;

        $delivery = StockDelivery::create([
            'id' => $id,
            'dateMake' => $request->created_at,
            'supplierId' => $request->supplierId
        ]);
        
        $prod = $request->product;
        foreach($request->qty as $qty)
        {

            StockDeliveryDetail::create([
                'deliveryId' => $delivery->id,
                'productId' => $prod[$index],
                'quantity' => $qty,
            ]);

            $index++;
        }

        
        foreach($request->product as $product)
        {
            Inventory::where('productId',$product)->increment('stock',$request->qty[$index2]);
            $index2++;
        }
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
    public function edit($id,$val)
    {
        $post = Inventory::find($id)->update([
            'stock' => $val
        ]);

        return response()->json($post);
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
