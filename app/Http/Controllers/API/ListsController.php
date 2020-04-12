<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\User;
use App\Lists;

class ListsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // Create User
    public function createUser(Request $request) {

        $this->validate($request, [
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'role' => 'required', 'string',
            'password' => 'required', 'string', 'min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return response($user, 201);
    }


    // Get all lists
    public function getLists() {
        $lists = Lists::all();
        return response($lists, 200);
    }

    // Save List
    public function saveList(Request $request) {

        // Validate
        $this->validate($request, [
            'list_title' => 'required',
            'list_notes' => 'sometimes',
        ]);

        // Save to DB
        $user = auth('api')->user();

        $list = Lists::create([
            'list_title' => $request->list_title,
            'list_notes' => $request->list_notes,
            'added_by' => $user->id,
        ]);

        return response($list, 201);
    }

    // Update List
    public function updateList(Request $request, $id) {
        $user = auth('api')->user();
        $list = Lists::findOrFail($id);

        //Validate
        $this->validate($request, [
            'list_title' => 'required',
            'list_notes' => 'sometimes',
        ]);

        //return response()->json($request->all());
        $updated = $list->update([
            'list_title' => $request->list_title,
            'list_notes' => $request->list_notes,
            'updated_by' => $user->id,
        ]);

        return response()->json($updated, 201);
    }

    // Delete List
    public function deleteList($id) {
        
        // Authorize For Super Admin
        $this->authorize('isSuperAdmin');

        $list = Lists::findOrFail($id);
        $deleted = $list->delete();

        return response()->json($deleted, 200);
    }
}
