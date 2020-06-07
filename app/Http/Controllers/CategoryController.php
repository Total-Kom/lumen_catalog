<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {}

    public function show_active()
    {
        return response()->json(Category::get_active());
    }

    public function files_to(int $id)
    {
        return response()->json(Category::files_to($id));
    }

    public function insert_file(Request $request, int $id)
    {}

    public function add_category_to_file(int $id, int $id_category)
    {}
};