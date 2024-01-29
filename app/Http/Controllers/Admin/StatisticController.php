<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\OrderController;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderRequest;

class StatisticController extends Controller
{

    public function index(Request $request)
    {
        // Ottieni la data corrente
        $currentDate = Carbon::now();

        // Calcola un anno fa dalla data corrente
        $lastYearDate = $currentDate->copy()->subYear();

        // Ottieni i dati per gli ultimi 12 mesi, inclusi il mese corrente
        $monthlyOrders = [];
        $monthlySales = [];

        // Assuming you have a logged-in user, retrieve the user ID
        $userId = $request->user()->id;

        for ($i = 0; $i < 12; $i++) {
            $currentMonth = $currentDate->copy()->subMonths($i);
            $key = $currentMonth->format('Y-m');

            $orders = Order::whereHas('products', function ($query) use ($userId) {
                $query->whereHas('restaurant', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                });
            })->whereYear('date', $currentMonth->year)
              ->whereMonth('date', $currentMonth->month)
              ->orderBy('id', 'DESC')
              ->get();

            // Modifica della query per conteggiare gli ordini totali per il mese corrente
            $orderCount = $orders->count();
            $totalSales = $orders->sum('total_price');

            $monthlyOrders[$key] = $orderCount;
            $monthlySales[$key] = $totalSales;
        }

        ksort($monthlyOrders);
        ksort($monthlySales);

        // Passa i dati alla vista
        return view('admin.statistics.index', compact('monthlyOrders','monthlySales', 'currentDate', 'lastYearDate'));
    }

}