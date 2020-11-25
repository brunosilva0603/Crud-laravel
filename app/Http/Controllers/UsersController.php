<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = Usuario::where('status',1)->get();
        return view('usuarios.list', ['users' => $users]);
    }

    public function new()
    {
        return view('usuarios.form');
    }

    public function add(User $request)
    {
        $users = new Usuario;
        $users = $users->create($request->all());
        return Redirect::to('/usuarios');
    }

    public function edit($id)
    {
        $users = Usuario::findOrFail($id);
        return view('usuarios.form', ['users' => $users]);
    }

    public function update($id, User $request)
    {
        $users = Usuario::findOrFail($id);
        $users->update($request->all());
        return Redirect::to('/usuarios');
    }

    public function delete( $id, User $request ){
        $users = Usuario::where($id);
        $users->update($request->status(0));
        return Redirect::to('/usuarios');


        //$users = $this->input->post('status');
        //$queryVar = ["status" => 1];
        //$this->db->where('id', $dados->idUsuario);
        //$this->db->update('minhaTabelaDeUsuarios', $queryVar);
    }
}
