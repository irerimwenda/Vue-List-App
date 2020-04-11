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
}
