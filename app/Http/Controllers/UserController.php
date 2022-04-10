<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users') //se hace una consulta para que muestro solo los usuarios que no han sido suscriptos y que estan listos para una suscripcion
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('subscriptions')
                    ->whereColumn('subscriptions.user_id', 'users.id');
            })->where('active', 1)
            ->get();

        // dd($users);

        return view('users.index')->with('users', $users); //se envia la informacion a la vista para el usuario
    }
}
