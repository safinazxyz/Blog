<?php

namespace App\Http\Controllers\Admin;

use App\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    public function getEnquiries(){
        $enquiries = Enquiry::orderBy('id','Desc')->get();
        return response()->json([
            'enquiries' => $enquiries
        ], 200);
    }
}
