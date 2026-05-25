<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Notifications\LowStockNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockLog;
use Illuminate\Http\Request;


class SaleController extends Controller
{
    public function create()
    {
        $products = Product::all();

        return view('sales.create', compact('products'));
    }public function index()
{
    $sales = Sale::latest()->get();

    return view('sales.index', compact('sales'));
}


  public function store(Request $request)
{
    $products = $request->products;

    if (!$products || count($products) == 0) {

        return back()->with('error', 'Cart is empty');

    }

    $grandTotal = 0;

    // CALCULATE TOTAL
    foreach ($products as $item)
    {
        $product = Product::findOrFail($item['product_id']);

        $subtotal = $product->price * $item['quantity'];

        $grandTotal += $subtotal;
    }

    // CREATE SALE
    $sale = Sale::create([

        'user_id' => auth()->id(),

        'total_amount' => $grandTotal,

        'payment_method' => $request->payment_method,
        'amount_paid' => $request->amount_paid,

'balance' =>
    $request->amount_paid - $total,

'payment_status' =>
    $request->amount_paid >= $total
        ? 'Paid'
        : 'Pending',
    ]);

    // SAVE ITEMS
    foreach ($products as $item)
    {
        $product = Product::findOrFail($item['product_id']);

        $subtotal = $product->price * $item['quantity'];

        // CREATE SALE ITEM
        SaleItem::create([

            'sale_id' => $sale->id,

            'product_id' => $product->id,

            'quantity' => $item['quantity'],

            'price' => $product->price,

            'subtotal' => $subtotal,

        ]);

        // DEDUCT STOCK
        $product->stock -= $item['quantity'];

        $product->save();
        if ($product->stock <= 5)
{
    $admin = User::first();

    $admin->notify(
        new LowStockNotification($product)
    );
}

        // STOCK LOG
        StockLog::create([

            'product_id' => $product->id,

            'type' => 'OUT',

            'quantity' => $item['quantity'],

            'note' => 'Sale completed',

        ]);
        
    }



    return redirect('/sales/' . $sale->id . '/receipt');
}
public function receipt($id)
{
    $sale = Sale::with('items.product')
        ->findOrFail($id);

    return view('sales.receipt', compact('sale'));
}
public function pdf($id)
{
    $sale = Sale::with('items.product')
        ->findOrFail($id);

    $pdf = Pdf::loadView('sales.pdf', compact('sale'));

    return $pdf->download('receipt-'.$sale->id.'.pdf');
}

    }

    return response()->json([
        'message' => 'Checkout successful'
    ]);

