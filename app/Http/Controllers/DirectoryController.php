<?php

namespace App\Http\Controllers;

use App\Directory;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectoryController extends Controller
{
    public function createDirectory(Request $request) {
        $directory_id = $request->input('directory_id');
        $file = Directory::create([
            'name' => $request->input('name'),
            'parent_directory' => $directory_id,
            'user_id' => Auth::user()->id,
        ]);

        return ($directory_id?redirect('/directory/'.$directory_id):redirect()->route('home'));
    }

    public function show($id) {
        $user_id = Auth::user()->id;
        $files = File::where('user_id','=',$user_id)->where('parent_directory','=',$id)->get();
        $directories = Directory::where('user_id','=',$user_id)->where('parent_directory','=',$id)->get();
        $currentDirectory = Directory::find($id);
        $directory_id = $currentDirectory->getAttribute('id');
        $breadCrumbs=Directory::getBreadCrumbs($directory_id);

        return view('home',compact('files','directories','currentDirectory','directory_id','breadCrumbs'));
    }

    public function delete($id) {
        $directory_id=Directory::find($id)->getAttribute('parent_directory');
//        $files=File::where('parent_directory','=',$directory_id);
//        $files->delete();
        $directory=Directory::find($id);
        $directory->delete();

        return ($directory_id?redirect('/directory/'.$directory_id):redirect()->route('home'));
    }

    public function rename(Request $request) {
        $id=$request->input('id');
        $directory_id=Directory::find($id)->getAttribute('parent_directory');
        $name=$request->input('name');

        $directory=Directory::find($id);
        $directory->name=$name;
        $directory->save();

        return ($directory_id?redirect('/directory/'.$directory_id):redirect()->route('home'));
    }
}
