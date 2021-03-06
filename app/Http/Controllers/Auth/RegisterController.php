<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $validator = Validator::make($request->all(), [ 
        //     'first_name' => 'required', 
        //     'last_name' => 'required', 
        //     'email' => 'required|email', 
        //     'password' => 'required', 
        // ]);
        // if ($validator->fails()) { 
        //     return response()->json(['error'=>$validator->errors()], 401);            
        // }
        $input = $request->userData;
        
        $input['password'] = bcrypt($input['password']); 
        $user_id = User::insertGetId($input);

        $data = array_merge($request->userProfile, ['user_id' => $user_id]);
    
        Profile::insertGetId($data);
        $user = User::find($user_id);

        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['user'] = $user;
        return response()->json($success); 
    }
    
}
