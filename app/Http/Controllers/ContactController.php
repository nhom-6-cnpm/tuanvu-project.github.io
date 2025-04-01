<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Services\Slider\SliderService;
use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        return view('contact', [
            'title' => 'Liên Hệ',
            'sliders' => $this->slider->show()
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'content' => 'required'
        ]);

        try {
            // Lưu vào CSDL
            Contact::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'content' => $request->input('content'),
                'status' => 0 // Chưa xem
            ]);

            // Gửi mail
            Mail::send('emails.contact', [
                'mailData' => [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'message' => $request->input('content')
                ]
            ], function($mail) use($request) {
                $mail->to('riotgame05122003@gmail.com');
                $mail->from($request->input('email'), $request->input('name'));
                $mail->subject('Liên Hệ Mới Từ: ' . $request->input('name'));
            });

            return redirect()->back()->with('success', 'Gửi tin nhắn thành công!');

        } catch (\Exception $err) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau!')
                ->withInput();
        }
    }
}
