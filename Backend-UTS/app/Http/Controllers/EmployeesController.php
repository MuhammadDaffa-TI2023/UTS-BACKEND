<?php

namespace App\Http\Controllers;
use App\Models\Employees;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index() {
        $employees = Employees::all();
    
        // Cek apakah koleksi kosong
        if ($employees->isEmpty()) {
            return response()->json([
                // Menghandle jika data kosong
                'message' => 'Tidak ada data employees ditemukan', 
                'data' => []
            ], 404);
        }
    
        $data = [
            'message' => 'Mengambil semua data employees',
            'data' => $employees
        ];
    
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'phone' => 'required|string|max:100',
            'address' => 'required|string|max:255',  
            'email' => 'required|email',
            'status' => 'required|string|max:200',
            'hired_on' => 'required|date',
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $employees= Employees::create($request->all());

        $data = [
            'message' => 'Student is created successfully',
            'data' => $employees,
        ];

        return response()->json($data, 201);
    }
    public function update(Request $request, string $id)
    {
        $employees = Employees::find($id);
    
        // Jika data tidak ditemukan, beri respons 404
        if (!$employees) {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }
    
        // Menyusun data input yang akan diupdate
        $input = [
            'name' => $request->name ?? $employees->name,
            'gender' => $request->gender ?? $employees->gender,
            'phone' => $request->phone ?? $employees->phone,
            'address' => $request->address ?? $employees->address,
            'email' => $request->email ?? $employees->email,
            'status' => $request->status ?? $employees->status,
            'hired_on' => $request->hired_on ?? $employees->hired_on,
        ];
    
        // Melakukan pembaruan data karyawan
        $employees->update($input);
    
        // Menyiapkan data yang akan dikirimkan dalam respons
        $data = [
            'message' => 'Berhasil mengubah data',
            'data' => $employees,
        ];
    
        // Mengirimkan respons sukses dengan status 200
        return response()->json($data, 200);
    }
    
 public function destroy(string $id)
 {
     $employees = Employees::find($id);

     if (!$employees) {
         return response()->json(['message' => 'Data tidak ditemukan!'], 404);
     }

     $employees->delete();

     $data = [
         'message' => 'Berhasil menghapus data',
         'data' => $employees,
     ];

     return response()->json($data,200);
}
    
    

    
}
