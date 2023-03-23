<?php

namespace App\Http\Controllers;

use App\Mail\Article_Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Recipe_SuggestsController extends Controller
{
    public function sender(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make(
            $data,
            [
                'email' => 'required|email|unique',
                'object' => 'required|string',
                'text' => 'required|string',
                'news_letter' => 'nullable|boolean',
            ],
            [
                'email.required' => 'Email obbligatoria',
                'email.email' => 'Email inserita non in modo corretto',
                'object.required' => 'Object obbligatorio',
                'text.required' => 'Text obbligatorio',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $email = new Article_Suggestion(
            sender: $data['email'],
            subject: $data['object'],
            message: $data['text'],
        );
        Mail::to(env('MAIL_FROM_ADDRESS'))->send($email);
        return response(null, 204);
    }
}
