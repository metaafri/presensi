<?php

namespace App\Http\Controllers;

use App\Models\Submmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmmissionController extends Controller
{
    public function index()
    {
        $submissions = Submmission::where('nik', Auth::guard('employee')->user()->nik)->get();
        return view('presensi.submission.index', compact('submissions'));
    }

    public function create()
    {
        return view('presensi.submission.create');
    }

    public function store(Request $request)
    {
        Submmission::create([
            'nik' => Auth::guard('employee')->user()->nik,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect(route('submission.index'))->with(['success' => 'Pengajuan Berhasil, Menunggu Approve']);
    }
}
