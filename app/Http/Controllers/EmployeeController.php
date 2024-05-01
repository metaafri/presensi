<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $nik = Auth::guard('employee')->user()->nik;
        $employee = Employee::where('nik', $nik)->first();

        return view('employee.index', compact('employee'));
    }

    public function update(Request $request, $nik)
    {
        $employee = Employee::where('nik', $nik)->first();

        if ($request->hasFile('photo')) {
            $photo = $nik . '.' . $request->file('photo')->getClientOriginalExtension();
        } else {
            $photo = $employee->photo;
        }

        if (!empty($request->password)) {
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'photo' => $photo,
                'password' => Hash::make($request->password),
            ];
        } else {
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'photo' => $photo,
            ];
        }

        $update = $employee->update($data);

        if ($update) {
            if ($request->hasFile('photo')) {
                $path = 'public/uploads/employees/';
                $request->file('photo')->storeAs($path, $photo);
            }

            return redirect()->back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Diubah']);
        }
    }
}
