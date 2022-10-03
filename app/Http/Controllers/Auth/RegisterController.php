<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Profile;
use phpseclib\Crypt\Random;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/admin/home';

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
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    public function registerApi(Request $request) 
    { 

        $input = $request->userData;
        
        $input['password'] = bcrypt($input['password']); 
        
        $input = array_merge($input, ['uid' => '2345678-564yg89']);
    
        $user_id = User::insertGetId($input);

        $data = array_merge($request->userProfile, ['user_id' => $user_id]);
    
        Profile::insertGetId($data);
        $user = User::find($user_id);

        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['user'] = $user;
        return response()->json($success); 
    }
    
}
