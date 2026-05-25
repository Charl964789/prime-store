<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::latest()->get();

        return view('purchases.index',
            compact('purchases'));
    }

    public function create()
    {
        $products = Product::all();

        $suppliers = Supplier::all();

        return view('purchases.create',
            compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $purchase = Purchase::create([

            'supplier_id' => $request->supplier_id,

            'purchase_date' => now(),

            'total_amount' => 0,

        ]);
        $request->validate([

    'supplier_id' => 'required',

    'products' => 'required',

]);

        $total = 0;

        foreach ($request->products as $item)
        {
            $product = Product::find($item['product_id']);

            $subtotal =
                $item['quantity'] *
                $item['cost_price'];

            PurchaseItem::create([

                'purchase_id' => $purchase->id,

                'product_id' => $product->id,

                'quantity' => $item['quantity'],

                'cost_price' => $item['cost_price'],

                'subtotal' => $subtotal,

            ]);

            // INCREASE STOCK
            $product->increment(
                'stock',
                $item['quantity']
            );

            $total += $subtotal;
        }

        $purchase->update([
            'total_amount' => $total
        ]);

        return redirect('/purchases')
            ->with('success',
                'Purchase completed');
    }
}