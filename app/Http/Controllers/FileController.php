<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {}

    public function update_file_name(Request $request)
    {
        $this->validate($request,   [
                                        'id' => 'required',
                                        'name' => 'required'
                                    ]);

        $file = File::findOrFail($request->id);

        $file->update($request->all());
        return response('[File id:'.$request->id.'] Updated successfully', 200);
    }
};