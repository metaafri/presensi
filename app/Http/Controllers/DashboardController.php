<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Submmission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->toDateString();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $nik = Auth::guard('employee')->user()->nik;
        $presensiToday = Presensi::whereDate('created_at', $today)->where('nik', $nik)->first();
        $presensiMonth = Presensi::whereBetween('created_at', [$startOfMonth, $endOfMonth])->where('nik', $nik)->latest()->get();

        $rekapAbsen = Presensi::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total_absen, SUM(IF(jam_in > "07:00", 1, 0)) as total_absen_terlambat')
            ->where('nik', $nik)
            ->groupBy('year', 'month')
            ->first();

        $leaderboards = Presensi::join('employees', 'presensis.nik', '=', 'employees.nik')
            ->whereDate('presensis.created_at', $today)
            ->orderBy('jam_in')
            ->get();

        $recapSubmmission = Submmission::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month,
                                    SUM(IF(status = "i", 1, 0)) as total_izin,
                                    SUM(IF(status = "s", 1, 0)) as total_sakit')
            ->where('nik', $nik)
            ->where('approve', 1)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('year', 'month')
            ->first();

        return view('dashboard.index', compact('presensiToday', 'presensiMonth', 'rekapAbsen', 'leaderboards', 'recapSubmmission'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
