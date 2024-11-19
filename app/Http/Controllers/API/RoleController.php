<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use Validator;

class RoleController extends Controller
{
    // Menampilkan semua role
    public function index()
    {
        $roles = RoleModel::paginate(10); // Pagination
        return response()->json($roles);
    }

    // Menampilkan detail role berdasarkan ID
    public function show($id)
    {
        $role = RoleModel::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return response()->json($role);
    }

    // Membuat role baru
    public function tambah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $role = RoleModel::create($request->all());
        return response()->json($role, 201);
    }

    // Memperbarui data role
    public function edit(Request $request, $id)
    {
        $role = RoleModel::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $role->update($request->all());
        return response()->json($role);
    }

    // Menghapus role
    public function hapus($id)
    {
        $role = RoleModel::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $role->update(['soft_delete' => 1]);
        return response()->json(['message' => 'Role deleted successfully']);
    }
}

