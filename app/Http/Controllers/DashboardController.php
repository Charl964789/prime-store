<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\SaleItem;
class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalCategories = Category::count();

        $totalSales = Sale::count();

        $revenue = Sale::sum('total_amount');

        $lowStock = Product::where('stock', '<=', 5)
            ->count();

        $recentSales = Sale::latest()
            ->take(5)
            ->get();
            $lowStockProducts = Product::where('stock', '<=', 5)
    ->latest()
    ->get();
    $salesByDay = Sale::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
    ->groupBy('date')
    ->orderBy('date', 'ASC')
    ->take(7)
    ->get();

$topProducts = SaleItem::selectRaw('product_id, SUM(quantity) as total_qty')
    ->groupBy('product_id')
    ->orderByDesc('total_qty')
    ->take(5)
    ->with('product')
    ->get();
    $expiringProducts = Product::whereDate(
        'expiry_date',
        '<=',
        Carbon::now()->addDays(7)
    )
    ->whereDate(
        'expiry_date',
        '>=',
        Carbon::now()
    )
    ->get();

$expiredProducts = Product::whereDate(
        'expiry_date',
        '<',
        Carbon::now()
    )
    ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSales',
            'revenue',
            'lowStock',
            'recentSales',
            'lowStockProducts',
            'salesByDay',
            'topProducts',
            'expiringProducts',
             'expiredProducts',
        ));

   $salesByDay = Sale::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
    ->groupBy('date')
    ->orderBy('date', 'ASC')
    ->take(7)
    ->get();
    $topProducts = SaleItem::selectRaw('product_id, SUM(quantity) as total_qty')
    ->groupBy('product_id')
    ->orderByDesc('total_qty')
    ->take(5)
    ->with('product')
    ->get();
 }
}