<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Lists;

class ListsController extends Controller
{
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
}
