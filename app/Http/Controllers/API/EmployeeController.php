<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class EmployeeController extends Controller
{
    // Menampilkan daftar karyawan dengan paginasi dan pencarian
    public function index(Request $request)
    {
        $query = EmployeeModel::query();

        // Pencarian berdasarkan nama karyawan
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $query->where('soft_delete', 0);
        $employees = $query->paginate(10);
        return response()->json($employees);
    }

    // Menampilkan detail karyawan
    public function tampil($id)
    {
        $employee = EmployeeModel::findOrFail($id);
        return response()->json($employee);
    }

    // Membuat karyawan baru
    public function tambah(Request $request)
    {
        if (Auth::user()->role->name != 'admin' && Auth::user()->role->name != 'manager') {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Anda tidak diperkenankan melakukan aksi ini!'
            ], 403);
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $employee = EmployeeModel::create($request->all());
        return response()->json($employee, 201);
    }

    // Memperbarui data karyawan
    public function edit(Request $request, $id)
    {
        if (Auth::user()->role->name != 'admin' && Auth::user()->role->name != 'manager') {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Anda tidak diperkenankan melakukan aksi ini!'
            ], 403);
        }

        $employee = EmployeeModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'phone_number' => 'sometimes|required|string|max:15',
            'address' => 'sometimes|required|string|max:255',
            'company_id' => 'sometimes|required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $employee->update($request->all());
        return response()->json($employee);
    }

    // Menghapus karyawan (soft delete)
    public function hapus($id)
    {
        if (Auth::user()->role->name != 'admin' && Auth::user()->role->name != 'manager') {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Anda tidak diperkenankan melakukan aksi ini!'
            ], 403);
        }

        $employee = EmployeeModel::findOrFail($id);
        $employee->update(['soft_delete' => 1]);
        return response()->json(['message' => 'Employee deleted successfully']);
    }
}

