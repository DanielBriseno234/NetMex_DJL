<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\enviarCorreo;	

class MessagesController extends Controller
{
    public function store(Request $request){
    //Requerimientos que necesita el formulario para poder enviar el correo
        $message = request()->validate([
            'name'=>'required',
            
            'asunto' => 'required',
            'descripcion' => 'required|min:30'
        ],
        [
            'name.required' => 'Introduzca el nombre.',
            
            'asunto.required' =>'Favor de introducir el asunto.',
            'descripcion.min' => 'Se necesita introducir mínimo 30 carácteres en la descripcion.',
            'descripcion.required' => 'Se necesita introducir descripcion.'
        ]);
        // 
        Mail::to('erichr2604@gmail.com')->send(new enviarCorreo($message));
        return back()->with('status','Recibimmos tu correo electronico gracias');
    }
}

