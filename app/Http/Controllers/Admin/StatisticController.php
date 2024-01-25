<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\OrderController;
use Carbon\Carbon;
use App\Models\Order;

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

        for ($i = 0; $i < 12; $i++) {
            $currentMonth = $currentDate->copy()->subMonths($i);
            $key = $currentMonth->format('Y-m');

            // Modifica della query per conteggiare gli ordini totali per il mese corrente
            $orderCount = Order::whereYear('date', $currentMonth->year)
                ->whereMonth('date', $currentMonth->month)
                ->count();

            $monthlyOrders[$key] = $orderCount;
        }

        ksort($monthlyOrders);

        // Passa i dati alla vista
        return view('admin.statistics.index', compact('monthlyOrders', 'currentDate', 'lastYearDate'));
    }

}
