<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;


class Api extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $list = Checklist::all();
        return response()->json([
            'status' => 'success',
            'list' => $list,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'itemName' => 'required|string|max:255',
        ]);

        $list = Checklist::create([
            'name' => $request->name,
            'itemName' => $request->itemName,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'List created successfully',
            'list' => $list,
        ]);
    }

    public function show($id)
    {
        $list = Checklist::find($id);
        return response()->json([
            'status' => 'success',
            'list' => $list,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'itemName' => 'required|string|max:255',
        ]);

        $list = Checklist::find($id);
        $list->name = $request->name;
        $list->itemName = $request->itemName;
        $list->save();

        return response()->json([
            'status' => 'success',
            'message' => 'List updated successfully',
            'list' => $list,
        ]);
    }

    public function destroy($id)
    {
        $list = Checklist::find($id);
        $list->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'List deleted successfully',
            'list' => $list,
        ]);
    }
}
