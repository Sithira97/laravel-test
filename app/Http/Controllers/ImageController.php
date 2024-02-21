<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function imageHandle(Request $request)
    {
        //return $request->all();

        //dd($request->file('uploadFile'));

        //$request->uploadFile->store('/images');

        $request->validate([
            'uploadFile'=>['required', 'max:500', 'min:100', 'mimes:png,jpg,gif' ]     //max: 500kB
        ]);
        $request->uploadFile->storeAs('/images','new_image.jpg');

        //return redirect()->route('/success');
        //return redirect()->back();
        return redirect('success');
    }

    public function download(){
        return response()->download(public_path('/storage/images/new_image.jpg'));
    }
}
