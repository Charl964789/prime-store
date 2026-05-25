<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->get();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        Supplier::create([

            'name' => $request->name,

            'phone' => $request->phone,

            'email' => $request->email,

            'address' => $request->address,

        ]);

        return redirect('/suppliers')
            ->with('success', 'Supplier added successfully');
    }
}