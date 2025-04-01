<?php

namespace App\Http\Services\Contact;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Session;

class ContactService
{
    public function sendMail($request)
    {
        try {
            $mailData = [
                'email' => $request->email,
                'message' => $request->message
            ];

            Mail::to('riotgame05122003@gmail.com')->send(new ContactMail($mailData));
            
            Session::flash('success', 'Gửi liên hệ thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Gửi liên hệ không thành công. Vui lòng thử lại');
            return false;
        }
    }
} 