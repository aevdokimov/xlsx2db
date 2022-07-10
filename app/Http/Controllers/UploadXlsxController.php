<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadXlsxRequest;

class UploadXlsxController extends Controller
{
    public function index()
    {
        return view('upload_xlsx');
    }

    public function handle(UploadXlsxRequest $request)
    {   
        $request->xlsx_file->store('xlsx');

        return redirect()->back()->with('success', 'Data will appear after processing');
    }
}
