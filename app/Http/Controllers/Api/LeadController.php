<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Lead;
use App\Models\Restaurant;
use App\Models\User;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        // verifico la validità dei dati
        $validator = Validator::make($data,
        [
            'name' => 'required|min:2|max:255',
            'email' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'phone' => 'required|min:8|max:10',
        ],
        [
            'name.required' => 'You must provide a name',
            'name.min' => 'Your name must be at least :min characters long',
            'name.max' => 'Your name can be at most :max characters long',

            'email.required' => 'You must provide an email',
            'email.min' => 'Your email must be at least :min characters long',
            'email.max' => 'Your email can be at most :max characters long',

            'address.required' => 'You must provide an address',
            'address.min' => 'Your address must be at least :min characters long',
            'address.max' => 'Your address can be at most :max characters long',

            'phone.required' => 'You must provide a phone number',
            'phone.min' => 'Your phone number must be at least :min characters long',
            'phone.max' => 'Your phone number can be at most :max characters long',

        ]
        );
        // se i dati non sono validi restituisco success=false e i messaggi di errore
        if($validator->fails()){
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success' , 'errors'));
        }
        // se non ci sono errori:

        // salvo i dati nel db
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();
        // invio l'email
        $toAddresses = ['franedsandi@gmail.com', $data['email']];
        Mail::to($toAddresses)->send(new NewContact($new_lead));
        // restituisco success = true
        $success = true;
        return response()->json(compact('success'));
    }
}
