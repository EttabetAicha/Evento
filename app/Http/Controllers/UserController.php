<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return response()->json($users);
    }

    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $validatedData = $request->validate([
            'role_name' => 'required|string|exists:roles,name',
        ]);

        $role = Role::where('name', $validatedData['role_name'])->first();

        $user->assignRole($role);

        return response()->json(['message' => 'Role assigned successfully']);
    }

    public function revokeRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $validatedData = $request->validate([
            'role_name' => 'required|string|exists:roles,name',
        ]);

        $role = Role::where('name', $validatedData['role_name'])->first();

        $user->removeRole($role);

        return response()->json(['message' => 'Role revoked successfully']);
    }
}
