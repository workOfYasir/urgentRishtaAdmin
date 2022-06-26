<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Hashing\BcryptHasher;

class DashboardController extends Controller
{
    public function index(){
        $users= User::whereHas("roles", function($q){ $q->where("name", "client"); })->get();
        $success['clients']=$users;
        return response()->json(['success'=>$success]);
    }

    /**
     * Add Client 
     */

    public function addClient(Request $request){

        
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'email' => 'required|email', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $password=$this->generateRandomString();
        $input = $request->all(); 

        $input['password'] = bcrypt($password); 
        $user = User::create($input);
        $user->assignRole('client');
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['first_name'] =  $user->first_name;
        $success['last_name'] =  $user->last_name;
        $success['role'] =  $user->getRoleNames();
        return response()->json(['success'=>$success]); 
    }
    /**
     * genrate random string
     */
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function editProfile(){
        $user= User::find(Auth::user()->id);
        return response()->json(['user'=>$user]); 
    }
    public function updateProfile(Request $request){
        $user= User::find($request->id)->update($request->all());
        return response()->json(['updated']); 
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [ 
            'password' => 'required',
            'newPassword' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $user= User::find($request->id);
        if (password_verify($request->password, $user->password)){ 
           $password= bcrypt($request->newPassword);
           $user->update([
               'password'=>$password,
           ]);
           return response()->json('updated'); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
}
