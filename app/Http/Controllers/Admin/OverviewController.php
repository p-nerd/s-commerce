<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->where('stock', '<', 5)
            ->get();

        return view('admin/overview/index', [
            'products' => $products,
        ]);
    }

    public function getSalesData(Request $request)
    {
        $period = $request->input('sales', 'last-7-days');

        switch ($period) {
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday()->endOfDay();
                break;
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::now();
                break;
            case 'last-7-days':
                $startDate = Carbon::now()->subDays(6)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
            case 'last-30-days':
                $startDate = Carbon::now()->subDays(29)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
            case 'last-90-days':
                $startDate = Carbon::now()->subDays(89)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
            case 'lifetime':
                $startDate = Order::min('created_at');
                $endDate = Carbon::now()->endOfDay();
                break;
            default:
                $startDate = Carbon::now()->subDays(6)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
        }

        $salesData = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total) as total_sales')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = [];
        $sales = [];

        foreach ($salesData as $data) {
            $dates[] = Carbon::parse($data->date)->format('d M');
            $sales[] = $data->total_sales;
        }

        return response()->json([
            'dates' => $dates,
            'sales' => $sales,
        ]);
    }
}
