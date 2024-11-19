<?php

namespace App\Http\Controllers\API;

use App\Models\CompanyModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckRole;
use Validator;

class CompanyController extends Controller
{    
    // Menampilkan semua perusahaan
    public function index()
    {
        $companies = CompanyModel::paginate(10); // Menggunakan pagination
        return response()->json($companies);
    }

    // Menampilkan detail perusahaan berdasarkan ID
    public function show($id)
    {
        $company = CompanyModel::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        return response()->json($company);
    }

    // Membuat perusahaan baru
    public function tambah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:companies,email',
            'phone_number' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $company = CompanyModel::create($request->all());
        return response()->json($company, 201);
    }

    // Memperbarui data perusahaan
    public function edit(Request $request, $id)
    {
        $company = CompanyModel::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $company->update($request->all());
        return response()->json($company);
    }

    // Menghapus perusahaan
    public function hapus($id)
    {
        $company = CompanyModel::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $company->update(['soft_delete' => 1]);
        return response()->json(['message' => 'Company deleted successfully']);
    }
}

