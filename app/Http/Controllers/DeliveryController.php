<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delivery;
use App\Supplier;
use App\Purchase;
use App\DeliveryDetail;
use App\Inventory;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Delivery::where('isActive',1)->get();
        return view('Delivery.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function purchase($id)
    {
        $purchase = Purchase::with('Supplier')->where('supplierId',$id)->get();
        return response()->json($purchase);

    }

    public function product($id)
    {
        $product = Purchase::with('Detail.Product')->where('id',$id)->get();
        return response()->json($product);
    }

    public function create()
    {
        $supplier = Supplier::where('isActive',1)->get();
        return view('Delivery.create',compact('supplier','purchase'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Delivery::all()->count() + 1;
        $id = 'ORDER'.str_pad($id, 5, '0', STR_PAD_LEFT); 

        $delivery = Delivery::create([
            'id' => $id,
            'supplierId' => $request->supplierId,
            'dateMake' => $request->created_at,
            'isActive' => 1
        ]);

        $index = 0;
        foreach($request->productId as $product)
        {
            DeliveryDetail::create([
                'deliveryId' => $delivery->id,
                'productId' => $product,
                'quantity' => $request->qtyReceived[$index],
            ]);
            $inventory = Inventory::where('productId',$product)->first();
            $inventory->increment('stock', $request->qtyReceived[$index]);
            $index++;
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
