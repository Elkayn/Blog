<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatisticResource;
use App\Models\Analitic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = StatisticResource::collection(Analitic::all())->resolve();
        return inertia('Admin/Statistic/Index', compact('statistics'));
    }
}
