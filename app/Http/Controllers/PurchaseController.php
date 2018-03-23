<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\PurchaseDetail;
use App\Supplier;
use App\Product;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Purchase::with('Supplier')->where('isActive',1)->get();
        return view('Purchase.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product($id)
    {
        $product = Product::with('Type')
            ->with('Brand')
            ->with('Variant')
            ->find($id);
        return response()->json($product);
    }

    public function final($id)
    {
        $purchase = Purchase::with('Detail.Product')
                    ->find($id);
        return response()->json($purchase);
    }

    public function finalize($id)
    {
        Purchase::find($id)->update(['isFinalize'=>1]);
        return redirect('/PurchaseOrder');
    }

    public function create()
    {
        $supplier = Supplier::where('isActive',1)->get();
        $product = Product::where('isActive',1)->get();
        return view('Purchase.create',compact('supplier','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Purchase::all()->count() + 1;
        $id = 'ORDER'.str_pad($id, 5, '0', STR_PAD_LEFT); 
       
        $purchase = Purchase::create([
            'id' => $id,
            'supplierId' => $request->supplierId,
            'dateMake' => $request->created_at,
            'isFinalize' => 0,
            'isDelivered' => 0
        ]);
        $index = 0;
        foreach($request->product as $product)
        {
            PurchaseDetail::create([
                'purchaseId' => $purchase->id,
                'productId' => $product,
                'quantity' => $request->qty[$index],
                'delivered' => 0,
                'price' => $request->price[$index],
            ]);
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
        $supplier = Supplier::where('isActive',1)->get();
        $product = Product::where('isActive',1)->get();
        $post = Purchase::with('Detail')->find($id);
        return view('Purchase.update',compact('supplier','product','post'));
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
        $purchase = Purchase::find($id)->update([
            'id' => $id,
            'supplierId' => $request->supplierId,
            'dateMake' => $request->created_at
        ]);
        $index = 0;
        PurchaseDetail::where('purchaseId',$id)->delete();
        foreach($request->product as $product)
        {
            PurchaseDetail::create([
                'purchaseId' => $id,
                'productId' => $product,
                'quantity' => $request->qty[$index],
                'delivered' => 0,
                'price' => $request->price[$index],
            ]);
            $index++;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Purchase::find($id)->update(['isActive' => 0]);
            return redirect('/PurchaseOrder');    
    }

    public function soft()
    {
        $post = Purchase::where('isActive',0)->get();
        return view('Purchase.soft',compact('post'));
    }

    public function reactivate($id)
    {
        Purchase::find($id)->update(['isActive' => 1]);
        return redirect('/PurchaseOrder');
    }

    public function remove($id)
    {
        
        $detal = PurchaseDetail::where('purchaseId',$id)->delete();
        $post = Purchase::find($id);
        $post->delete();
        return redirect('/PurchaseOrder/Soft');
    }
}
