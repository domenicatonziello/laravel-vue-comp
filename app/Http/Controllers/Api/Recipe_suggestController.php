<?php

namespace App\Http\Controllers\Api;

use App\Mail\Article_Suggestion;
use App\Http\Controllers\Controller;
use App\Models\Recipes_suggest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class Recipe_suggestController extends Controller
{
    public function send(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make(
            $data,
            [
                'email' => 'bail|required|email',
                'object' => 'bail|required|string',
                'text' => 'bail|required|string',
                'news_letter' => 'nullable|boolean',
            ],
            [
                'email.required' => 'La email è obbligatoria',
                'email.email' => 'La email non è valida',
                'text.required' => 'Non è stata inserito il nome della ricetta in modo corretto',
                'news_letter.boolean' => 'Non è stato inserito in modo corretto',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        if (Arr::exists($data, 'news_letter')) {
            $exists = Recipes_suggest::where('email', $data['email'])->count();
            $contact = new Recipes_suggest();
            $contact->email = $data['email'];
            $contact->save();
        }
        $mail = new Article_Suggestion(
            $data['email'],
            $data['object'],
            $data['text']
        );
        Mail::to(env('MAIL_FROM_ADDRESS'))->send($mail);
        return response(null, 204);
    }
}
