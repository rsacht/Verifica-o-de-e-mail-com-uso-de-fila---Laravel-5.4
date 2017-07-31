<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

//Adição de namespaces para o Envio de e-mail de Cadastro
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Jobs\SendVerificationEmail;

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
    protected $redirectTo = '/home';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            //Add email_token com codificação base64 para o endereço de e-mail do usuário
            'email_token' => base64_encode($data['email']),
        ]);
    }
    
    //Métodos adicionados
    /**
    * Lidar com um pedido de registro para o aplicativo.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        //O método Registro() foi substituido e agora acrescento duas linhas nele
        dispatch(new SendVerificationEmail($user));
        return view(‘verification’);
    }
    
    /**
    Desta forma, o e-mail é enviado para a fila e, em vez de iniciar sessão diretamente nesse usuário, eu o redirecionarei para outra página que solicitará que ele verifique seu e-mail para continuar. Em seguida, criei um novo método de verificação verify() que verificará o usuário e seu token. Em seguida, criarei as visualizações que liguei nestes dois métodos em Views/emailConfirm.blade.php.
    */
    /**
    * Lidar com um pedido de registro para o aplicativo.
    *
    * @param $token
    * @return \Illuminate\Http\Response
    */
    public function verify($token)
    {
        $user = User::where(‘email_token’,$token)->first();
        $user->verified = 1;
        if($user->save()){
            return view(‘emailconfirm’,[‘user’=>$user]);
        }
    }
}
