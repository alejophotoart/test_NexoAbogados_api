<?php

namespace App\Http\Controllers;

use App\Models\Recurrent;
use Illuminate\Http\Request;

class RecurrentController extends Controller
{
    public function index()
    {
        $recurrents = Recurrent::with(['subscription'])->get(); //consulta que trae informacion de las recurrencias

        // dd($recurrents);

        return view('recurrents.index')->with('recurrents', $recurrents); //enviar la informacion de la consulta a la vista
    }
}
