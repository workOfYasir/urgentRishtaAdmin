<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
    public function forgotPassword(Request $request) {
        $data = array('name'=>"Virat Gandhi");
        $email = $request->email;
        Mail::send(['text'=>'mail'], $data, function($message,$email) {
            $message->to($email, 'Tutorials Point')->subject
                ('Laravel Basic Testing Mail');
            $message->from(env('MAIL_USERNAME'),'Virat Gandhi');
        });
        $fourRandomDigit = mt_rand(1000,9999);
        
       return view('mail.forgot')->with('fourRandomDigit',$fourRandomDigit);
    }
    public function html_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
                ('Laravel HTML Testing Mail');
            $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
    }
    public function attachment_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
                ('Laravel Testing Mail with Attachment');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
    }
}