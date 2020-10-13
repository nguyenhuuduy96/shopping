<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class ContactController extends Controller
{
    public function SenContact(Request $request){
        $input = $request->all();
        $title = 'Visitor Feedback - '.$input["name"].' !';
        $data =array('name'=>$input["name"],'email'=>$input["email"], 'content'=>$input['content'],'hotline'=>$input['hotline']);
        Mail::send('home.sendmails.contact-send-mail', $data, function($message) use ($title){
            $message->from('support@app.com', 'Shopping');
	        $message->to('nguyenhuuduy0796@gmail.com', 'Visitor')->subject($title);
	    });
        // return response()->json('success'=>'success !');
    }
}
