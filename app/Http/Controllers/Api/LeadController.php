<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Lead;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\User;
use App\Mail\NewContact;
use App\Mail\OrderContact;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        // verifico la validità dei dati
        $validator = Validator::make($data,
        [
            'name' => 'required|min:2|max:255',
            'email' => 'required|min:2|max:255',
            'message' => 'required|min:2',
            'address' => 'required|min:2|max:255',
            'phone' => 'required|min:8|max:10',
            // 'user_id' => 'required|exists:users,id'
        ],
        [
            'name.required' => 'You must provide a name',
            'name.min' => 'Your name must be at least :min characters long',
            'name.max' => 'Your name can be at most :max characters long',

            'email.required' => 'You must provide an email',
            'email.min' => 'Your email must be at least :min characters long',
            'email.max' => 'Your email can be at most :max characters long',

            'message.required' => 'You must provide a message',
            'message.min' => 'Your message must be at least :min characters long',

            'address.required' => 'You must provide an address',
            'address.min' => 'Your address must be at least :min characters long',
            'address.max' => 'Your address can be at most :max characters long',

            'phone.required' => 'You must provide a phone number',
            'phone.min' => 'Your phone number must be at least :min characters long',
            'phone.max' => 'Your phone number can be at most :max characters long',

            // 'users_id.required' => 'There are not users associates',
            // 'users_id.exists' => 'User does not exists',
        ]
        );

      // Se i dati non sono validi restituisco success=false e i messaggi di errore
      if ($validator->fails()) {
        $success = false;
        $errors = $validator->errors();
        return response()->json(compact('success', 'errors'));
    }

        // Salvo i dati nel db
        $new_lead = new Lead();
        $new_lead->fill($request->all());
        $new_lead->save();

        // $new_order = new Order();
        // $new_order->fill($request->all());
        // $new_order->save();




        // --------------------------------------------------------------------------------

        // Ottieni l'user_id associato al lead
        $userId = $new_lead->user_id;
        // Ottieni l'email dello user
        $userEmail = User::where('id', $data['user_id'])->value('email');

          // Invio l'email
        //   $toAddresses = [$userEmail, $data['email']];
        //   Mail::to($toAddresses)->send(new NewContact($new_lead));
          Mail::to($data['email'])->send(new NewContact($new_lead , 'owner'));
          Mail::to($userEmail)->send(new NewContact($new_lead , 'customer'));



        // -----------------------------------------------------------------------------------

// invio generico funzionante vvvvvvvvvvvvvv
        // // invio la mail
        // $toAddresses = ['info@info.com' , $data['email']];
        // Mail::to($toAddresses)->send(new NewContact($new_lead));

        // Restituisco success = true
        $success = true;
        return response()->json(compact('success'));
    }
}

