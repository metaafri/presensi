<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Submmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $rekapAbsen = Presensi::selectRaw('COUNT(nik) as total_hadir, SUM(IF(jam_in > "07:00", 1, 0)) as total_terlambat')
            ->where('created_at', $today)
            ->first();

        $recapSubmmission = DB::table('submmissions')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(IF(status = "i", 1, 0)) as total_izin'), DB::raw('SUM(IF(status = "s", 1, 0)) as total_sakit'))
            ->where('approve', 1)
            ->groupBy('date')
            ->get();

        return view('admin.dashboard', compact('rekapAbsen', 'recapSubmmission'));
    }
}
