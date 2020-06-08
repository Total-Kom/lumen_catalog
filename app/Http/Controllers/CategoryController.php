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

    public function insert_file(Request $request)
    {
        $this->validate($request,   [
                                        'id_file' => 'required',
                                        'id_category' => 'required'
                                    ]);

        $record = Category::add_file(auth()->user()->id,
                                        $request->id_file,
                                        $request->id_category);

        if($record)
        {
            return response()->json($record, 200);
        }

        
        return response('Found file: '.$request->id_file.' to category:'.$request->id_category, 403);
        
    }

    public function delete_file(Request $request)
    {
        $record = Category::remove_file(auth()->user()->id,
                                        $request->id_file,
                                        $request->id_category);

        $record->delete();
        return "qwe";
    }
};