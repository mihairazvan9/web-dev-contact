<?php

namespace App\Http\Controllers;


use App\Mail\ContactMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    public function submit(ContactRequest $request)
    {
        try {
            $data = $request->validated();
            Mail::to($data['email'])->send(new ContactMail(...array_values($data)));
            return response()->json(['message' => 'E-mail sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
