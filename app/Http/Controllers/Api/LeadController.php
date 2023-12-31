<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Lead;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request){
        // saving request
        $data = $request->all();

        $validator = Validator::make($data,
        [
            'name' => 'required|min:2|max:255',
            'email' => 'required|min:2|max:255',
            'message' => 'required|min:2',
        ],
        [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least :min characters.',
            'name.max' => 'The name may not be greater than :max characters.',
            'email.required' => 'The email field is required.',
            'email.min' => 'The email must be at least :min characters.',
            'email.max' => 'The email may not be greater than :max characters.',
            'message.required' => 'The message field is required.',
            'message.min' => 'The message must be at least :min characters.',
        ]);

        // If data is not valid, I return success=false along with error messages.

        if($validator->fails()){
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }

        // Saving data in the database

            $new_lead = new Lead();
            $new_lead->fill($data);
            $new_lead->save();

        // sending the email

            Mail::to('petrino.silvia@gmail.com')->send(new NewContact($new_lead));

        // If there are no errors, returning success=true.

            $success = true;
            return response()->json(compact('success'));
    }
}
