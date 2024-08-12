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

    public function sales(Request $request)
    {
        $period = $request->input('sales', 'last-7-days');

        switch ($period) {
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday()->endOfDay();
                $groupByFormat = '%H:00'; // Group by hours
                $dateFormat = 'H:00';     // Format for displaying
                $selectFormat = "strftime('%H', created_at) || ':00'"; // SQLite format
                break;
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::now();
                $groupByFormat = '%H:00'; // Group by hours
                $dateFormat = 'H:00';     // Format for displaying
                $selectFormat = "strftime('%H', created_at) || ':00'"; // SQLite format
                break;
            case 'last-7-days':
                $startDate = Carbon::now()->subDays(6)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $groupByFormat = '%Y-%m-%d'; // Group by day
                $dateFormat = 'd M';         // Format for displaying
                $selectFormat = "strftime('%Y-%m-%d', created_at)"; // SQLite format
                break;
            case 'last-30-days':
                $startDate = Carbon::now()->subDays(29)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $groupByFormat = '%Y-%m-%d'; // Group by day
                $dateFormat = 'd M';         // Format for displaying
                $selectFormat = "strftime('%Y-%m-%d', created_at)"; // SQLite format
                break;
            case 'this-year':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfDay();
                $groupByFormat = '%Y-%m'; // Group by month
                $dateFormat = 'M Y';      // Format for displaying
                $selectFormat = "strftime('%Y-%m', created_at)"; // SQLite format
                break;
            case 'last-year':
                $startDate = Carbon::now()->subYear()->startOfYear();
                $endDate = Carbon::now()->subYear()->endOfYear();
                $groupByFormat = '%Y-%m'; // Group by month
                $dateFormat = 'M Y';      // Format for displaying
                $selectFormat = "strftime('%Y-%m', created_at)"; // SQLite format
                break;
            case 'lifetime':
                $startDate = Order::min('created_at');
                $endDate = Carbon::now()->endOfDay();
                $groupByFormat = '%Y'; // Group by year
                $dateFormat = 'Y';     // Format for displaying
                $selectFormat = "strftime('%Y', created_at)"; // SQLite format
                break;
            default:
                $startDate = Carbon::now()->subDays(6)->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $groupByFormat = '%Y-%m-%d'; // Group by day
                $dateFormat = 'd M';         // Format for displaying
                $selectFormat = "strftime('%Y-%m-%d', created_at)"; // SQLite format
        }

        $salesData = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw("$selectFormat as date, SUM(total) as total_sales")
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = [];
        $sales = [];

        foreach ($salesData as $data) {
            $dates[] = Carbon::parse($data->date)->format($dateFormat);
            $sales[] = $data->total_sales;
        }

        return response()->json([
            'dates' => $dates,
            'sales' => $sales,
        ]);
    }
}
