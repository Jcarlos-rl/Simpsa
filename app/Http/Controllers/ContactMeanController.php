<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Newsletter;
use Illuminate\Http\Request;

class ContactMeanController extends Controller
{
    public function newsletter(Request $request, $channel)
    {
        $request->validate([
            'email' => 'required'
        ]);

        $newsletter = $request->except('_token');
        $newsletter['channel'] = $channel;

        Newsletter::create($newsletter);

        return redirect()->back()->with('success','Gracias por suscribirse a nuestro Newsletter');
    }

    public function contact(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'affair' => 'required',
            'message' => 'required',
        ]);

        Contact::create($request->except('_token'));

        return redirect()->back()->with('success','Gracias por contactarte con nosotros, en unos momentos nos comunicaremos contigo.');
    }
}
