<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Supplier;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

      $suppliers = Supplier::all();

return view('products.create', compact('categories'),
    compact('suppliers')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'manufacture_date' => $request->manufacture_date,

            'expiry_date' => $request->expiry_date,
        ]);

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'barcode' => $request->barcode,
            'supplier_id' => $request->supplier_id,
            'manufacture_date' => $request->manufacture_date,

            'expiry_date' => $request->expiry_date,
        ]);

        return redirect('/products')
            ->with('success', 'Product added successfully');
    }

   public function edit($id)
{
    $product = Product::findOrFail($id);

    $categories = Category::all();

    $suppliers = Supplier::all();

    return view('products.edit',
        compact(
            'product',
            'categories',
            'suppliers'
        ));
}

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return redirect('/products')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect('/products')
            ->with('success', 'Product deleted successfully');
    }
    
}