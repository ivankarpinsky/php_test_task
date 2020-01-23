<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{


    public function upload(Request $request) {
        $directory_id = $request->input('directory_id');

        $file = File::create([
            'usersName' => $request->file('file')->getClientOriginalName(),
            'path' => $request->file('file')->store('uploads','public'),
            'size' => $request->file('file')->getSize(),
            'user_id' => Auth::user()->id,
            'parent_directory' => $directory_id,
        ]);

        return ($directory_id?redirect('/directory/'.$directory_id):redirect()->route('home'));
    }

    public function delete($id) {
        $directory_id=File::find($id)->getAttribute('parent_directory');
        $file=File::find($id)->delete($id);

        return ($directory_id?redirect('/directory/'.$directory_id):redirect()->route('home'));
    }

    public function rename(Request $request) {
        $id=$request->input('id');
        $directory_id=File::find($id)->getAttribute('parent_directory');
        $name=$request->input('name');

        $file=File::find($id);
        $file->usersName=$name;
        $file->save();

        return ($directory_id?redirect('/directory/'.$directory_id):redirect()->route('home'));
    }
}


