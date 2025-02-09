<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'UsuarioOficial' =>'required',
            'FilmeFavorito' => 'required',
            'cep' =>'required',
            'rua' =>'required',
            'bairro' =>'required',
            'uf' =>'required',
            'cidade' =>'required',
            'CPF' =>'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    //protected function create(array $data)
    //{
    //    return User::create([
    //        'name' => $data['name'],
    //        'email' => $data['email'],
    //        'role'=>2,
    //         'UsuarioOficial'=>$data['UsuarioOficial'],
    //         'FilmeFavorito'=>$data['FilmeFavorito'],
    //         'cep'=>$data['cep'],
    //         'rua'=>$data['rua'],
    //         'bairro'=>$data['bairro'],
    //         'uf'=>$data['uf'],
    //         'cidade'=>$data['cidade'],
    //         'CPF'=>$data['CPF'],
    //         'password' => Hash::make($data['password']),
    //    ]);
    // }

    function register(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'UsuarioOficial' =>'required',
            'FilmeFavorito' => 'required',
            'cep' =>'required',
            'rua' =>'required',
            'bairro' =>'required',
            'uf' =>'required',
            'cidade' =>'required',
            'CPF' =>'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->UsuarioOficial = $request->UsuarioOficial;
        $user->FilmeFavorito = $request->FilmeFavorito;
        $user->cep = $request->cep;
        $user->rua = $request->rua;
        $user->bairro = $request->bairro;
        $user->uf = $request->uf;
        $user->cidade = $request->cidade;
        $user->CPF = $request->CPF;
        $user->password = $request->password;

        if( $user->save() ){

            return redirect()->back()->with('success','Cadastrado com sucesso!');
        }else{
            return redirect()->back()->with('error','Falha ao realizar o cadastro');
        }
    }



}
