<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
  
    
    protected function redirectTo(){

        $user =auth()->user()->roles->pluck('name');
        
        // dd($user[0]);
        if ($user[0]=='administrator') {
         
            return redirect('/admin/home');
        }else if($user[0]=='artist'){
            return 'artist';
        }else if($user[0]=='customer'){
            return 'customer';
        }

        // if ($user->hasRole('artist')) {
        //     // dd('ok');
        //     return redirect('/artist/home');
        // }

        // if ($user->hasRole('customer')) {
        //     return redirect('/customer/home');
        // }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // dd( $user = Auth::user());
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function loginApi(Request $request){ 
        $validator = Validator::make($request->all(), [ 
            
            'email' => 'required|email', 
            'password' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['role']= $user->roles->pluck('name');
            return response()->json(['success' => $success]); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    
}
