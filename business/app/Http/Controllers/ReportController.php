<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $dealsByStage = Deal::query()
            ->select('stage', DB::raw('SUM(value) as total_value'))
            ->groupBy('stage')
            ->get();

        $chartLabels = $dealsByStage->pluck('stage');
        $chartData = $dealsByStage->pluck('total_value');

        return view('reports.index', compact('chartLabels', 'chartData'));
    }
}