<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();
        $timestamp = now()->roundMinute()->timestamp;

        dump($timestamp);
        
        
        // $timestamp = now();

        // dump((string) $timestamp->roundMinute());

        // $date = Carbon::parse('2021-07-28 16:42:13');

        // dump($date);

        // $t = Carbon::parse($date->roundMinute())->timestamp;
        // dump($t);
        // $test = Carbon::parse($timestamp->roundMinute())->timestamp;

        // dump($test);

        dd('*************');
        
        return view('auth.dashboard');
    }
}
