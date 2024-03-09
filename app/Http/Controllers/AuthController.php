<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;



class AuthController extends Controller
{


    protected $utilisateur;
    public function __construct()
    {
        $this->utilisateur = new User();
    }
    public function loginpage()
    {
        Session::forget('user_id');

        return view('auth.login');
    }
    public function logout(){
        Session::forget('user_id');
        return redirect('/');
    }



    public function Register(Request $request)
    {
        $password = $request->password;
        $c_password = $request->c_password;
        if ($c_password == $password) {
            $role = 3;
            $this->validate($request, [
                'name' => 'required|string|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ], [
                'name.required' => 'Le champ nom est important',
                'name.unique' => 'Ce nom est déjà pris',
                'email.required' => 'Le champ email est important',
                'email.email' => 'Veuillez entrer une adresse email valide',
                'email.unique' => 'Cet email est déjà pris',
                'password.required' => 'Le champ mot de passe est important',
                'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            ]);

            $utilisateur = $this->utilisateur;
            $utilisateur->name = $request->name;
            $utilisateur->email = $request->email;
            $utilisateur->password = Hash::make($request->password);
            $utilisateur->role_id = $role;
            $utilisateur->save();
            return redirect()->to('/');
        } else {
            return redirect()->to('/register')
                ->withErrors($request->validate)
                ->withInput()
                ->with('msg', 'La comfirmation de mot de pass est incorrect');
        }
    }

    public function Login(Request $request)
    {


        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Le champ email est important',
            'email.email' => 'Veuillez entrer une adresse email valide',
            'email.exists' => "Cet email n'existe pas",
            'password.required' => 'Le champ mot de passe est important',
        ]);
        $email = $request->email;
        $password = $request->password;
        $utilisateur = $this->utilisateur;
        $utilisateur = $utilisateur->where('email', $email)->first();
        if (Hash::check($password, $utilisateur->password)) {

            Session::put('user_id', $utilisateur->id);
            session::put('role_id', $utilisateur->role_id);

            $role_id = $utilisateur->role_id;
            if ($role_id == 1) {
                return redirect()->to('/dashboardpage');
            }
            if ($role_id == 2) {
                return redirect()->to('/eventpageorg');
            } else {
                return redirect()->to('/index');
            }
        } else {
            return redirect()->to('/')->withErrors(['email' => 'Email or password incorrect'])->withInput();
        }
    }

    public function forgotpage()
    {
        return view('Auth.forgot');
    }

    public function changepass($token)
    {
        $checktoken = $this->utilisateur->where('remember_token', $token)->first();
        if (!empty($checktoken)) {

            return view('auth.changepass');
        } else {
            abort(403);
        }
    }

    public function reset_pass($token, Request $request)
    {

        $this->validate($request, [
            'pass' => 'required|string|min:8',
        ], [
            'pass.required' => 'Le champ mot de passe est important',
            'pass.min' => 'Le mot de passe doit contenir au moins 8 caractères',
        ]);

        $checktoken = $this->utilisateur->where('remember_token', $token)->first();

        if (!empty($checktoken) && $request->pass == $request->c_pass) {

            $checktoken->remember_token = Str::random(60);
            $checktoken->password = Hash::make($request->pass);
            $checktoken->save();
            return redirect('/')->with("msg", "Le Mot De pass a ete changer avec succes");
        } else {
            abort(403);
        }
    }


    public function checkemail(Request $request)
    {
        $checkemail = $this->utilisateur->where('email', $request->email)->first();

        if (!empty($checkemail)) {
            $checkemail->remember_token = Str::random(60);
            $checkemail->save();

            Mail::to($checkemail->email)->send(new ForgotPassMail($checkemail));

            return back()->with('msg', 'Check your email for the password reset link.');
        } else {
            return redirect('/resetpass')->with('msg', 'Email does not exist.');
        }
    }
}
