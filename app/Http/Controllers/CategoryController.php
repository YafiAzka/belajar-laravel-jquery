<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->ajax) {
            return DataTables::of($categories)->make(true);
        }
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|min:3|max:30',
                'type' => 'required',
            ]
        );

        Category::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return response()->json(['message' => 'Success Add Category'], 200);
    }


    public function show()
    {
    }

    public function update(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }
}
