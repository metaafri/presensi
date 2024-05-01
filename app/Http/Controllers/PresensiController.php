<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->toDateString();
        $nik = Auth::guard('employee')->user()->nik;
        $validate = Presensi::whereDate('created_at', $today)->where('nik', $nik)->first();

        return view('presensi.index', compact('validate'));
    }

    public function store(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $nik = Auth::guard('employee')->user()->nik;
        $tgl_presensi = date('Y-m-d');
        $jam = date("H:i:s");

        $latOffice = -6.908361;
        $lngOffice = 107.62674;

        $location = $request->lokasi;
        $userLocation = explode(",", $location);
        $latUser = $userLocation[0];
        $lngUser = $userLocation[1];

        $distance = $this->distance($latOffice, $lngOffice, $latUser, $lngUser);
        $radius = round($distance["meters"]);

        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nik . "_" . $tgl_presensi . "_" . Str::random(6);
        $imageParts = explode(";base64", $image);
        $imageBase64 = base64_decode($imageParts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        $absen = Presensi::whereDate('created_at', $today)->where('nik', $nik)->first();

        if ($radius > 20) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, Anda diluar Jangkauan!'
            ], 403);
        } else {
            if ($absen) {
                $update = $absen->update([
                    'jam_out' => $jam,
                    'picture_out' => $fileName,
                    'location_out' => $location
                ]);

                if ($update) {
                    Storage::put($file, $imageBase64);

                    return response()->json([
                        'success' => true,
                        'type' => 'out',
                        'message' => "Absen Pulang Berhasil"
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "Internal Server Error"
                    ], 500);
                }
            } else {
                $save = Presensi::create([
                    'nik' => $nik,
                    'jam_in' => $jam,
                    'picture_in' => $fileName,
                    'location_in' => $location
                ]);

                if ($save) {
                    Storage::put($file, $imageBase64);

                    return response()->json([
                        'success' => true,
                        'type' => 'in',
                        'message' => "Absen Masuk Berhasil"
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "Internal Server Error"
                    ], 500);
                }
            }
        }
    }

    public function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);;
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;

        return compact('meters');
    }

    public function history()
    {
        $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('presensi.history.index', compact('month'));
    }

    public function getHistory(Request $request)
    {
        $nik = Auth::guard('employee')->user()->nik;
        $month = $request->month;
        $year = $request->year;

        $histories = Presensi::whereRaw('MONTH(created_at)="' . $month . '"')
            ->whereRaw('YEAR(created_at)="' . $year . '"')
            ->where('nik', $nik)
            ->orderBy('created_at')
            ->get();

        return view('presensi.history.get', compact('histories'));
    }
}
