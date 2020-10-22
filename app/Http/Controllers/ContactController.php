<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\Setting;
class ContactController extends Controller
{
    public function SenContact(Request $request){
        $input = $request->all();
        $setting = !empty(Setting::first()) ? Setting::first(): null;
        $title = 'Visitor Feedback - '.$input["name"].' !';
        $data =array('name'=>$input["name"],'email'=>$input["email"], 'content'=>$input['content'],'hotline'=>$input['hotline']);
        Mail::send('home.sendmails.contact-send-mail', $data, function($message) use ($title,$setting){
            $message->from('support@app.com', 'Shopping');
            
            $email = !empty($setting->email_contact) ? $setting->email_contact :'kenstudy11@gmail.com';
            
	        $message->to($email, 'Visitor')->subject($title);
	    });
        // return response()->json('success'=>'success !');
    }
}
