<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;

class FileUploadController extends Controller
{
    /**
     * FileUpload Upload view
     */
    public function createUploadForm(){
        return view('fileUploadView');
    }


    public function fileUploadForm(Request $request){
        $request->validate([
            'file' => 'required'
//            'file' => 'required|mimes:csv|max:2048'
        ]);
        $fileModel = new FileUpload;
        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time().'_'.$request->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
            return back()
                ->with('success','FileUpload has been uploaded.')
                ->with('file', $fileName);
        }
    }

}
