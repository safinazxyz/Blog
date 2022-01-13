<?php

namespace App\Http\Controllers;

use App\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{

    public function sendEnquiry(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required|min:2|max:50',
                'subject' => 'required|min:2|max:50',
                'message' => 'required|min:2|max:500',
                'email' => 'required',

            ];
            $customMessages = [
                'name.required' => 'Lütfen adınızı yazınız!',
                'name.min' => 'En az 2 karakter olmalı!',
                'name.max' => 'Lütfen 50 karakterden az yazınız!',
                'email.required' => 'Lütfen e-posta adresinizi yazınız!',
                'subject.required' => 'Lütfen bir konu başlığı yazınız!',
                'subject.min' => 'En az 2 karakter olmalı!',
                'subject.max' => 'Lütfen 50 karakterden az yazınız!',
                'message.required' => 'Lütfen mesajınızı yazınız!',
                'message.min' => 'En az 2 karakter olmalı!',
                'message.max' => 'Lütfen max 500 karakter kullanınız!',

            ];
            $this->validate($request, $rules, $customMessages);
            $enquiry = new Enquiry;
            $enquiry->name = $data['name'];
            $enquiry->email = $data['email'];
            $enquiry->subject = $data['subject'];
            $enquiry->message = $data['message'];
            $enquiry->save();
        }
    }
}
