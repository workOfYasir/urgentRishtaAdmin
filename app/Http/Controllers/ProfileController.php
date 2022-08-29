<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\ProfilePicture;
use App\Models\PartnerPreferences;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $id = Profile::insertGetId($request->data);
        $data = Profile::find($id);
        return response()->json([
            ['addedProfile' => $data],
            200,
        ]);
    }
    public function update(Request $request)
    {
        $data = Profile::where('user_id',Auth::user()->id);
        $user = User::where('id',Auth::user()->id);
        $user->update($request->user);
        $data->update($request->data);
        return response()->json([
            ['updatedProfile' => $request->data],
            200,
        ]);

    }
    public function delete(Request $request)
    {
        $user = Profile::find($request->id);
        $user->delete();
    }
    public function getProfile(Request $request)
    {
        $user = Profile::where('user_id',($request->user_id==null?Auth::user()->id:$request->user_id))->with('country')->with('state')->with('sector')->with('city')->with('religion')->with('cast')->with('user')->get();
        
        $auth_user = PartnerPreferences::where('user_id',Auth::user()->id)->first();
        $other_user = PartnerPreferences::where('user_id', $request->user_id)->first();
        if($auth_user==null||$other_user==null){
            $data['age']=false;
            $data['height']=false;
            $data['religion']=false;
            $data['mother_tongue']=false;
            $data['martial_status']=false;
            $data['community']=false;
            $data['country_living_in']=false;
            $data['city']=false;
            $data['state_living_in']=false;
            $data['city']=false;
        }else{
            ($auth_user->age==$other_user->age ?$data['age']=true:$data['age']=false);
            ($auth_user->height==$other_user->height ?$data['height']=true:$data['height']=false);
            ($auth_user->martial_status==$other_user->martial_status ?$data['martial_status']=true:$data['martial_status']=false);
            ($auth_user->religion==$other_user->religion ?$data['religion']=true:$data['religion']=false);
            ($auth_user->mother_tongue==$other_user->mother_tongue ?$data['mother_tongue']=true:$data['mother_tongue']=false);
            ($auth_user->community==$other_user->community ?$data['community']=true:$data['community']=false);
            ($auth_user->country_living_in ==$other_user->country_living_in ?$data['country_living_in']=true:$data['country_living_in']=false);
            ($auth_user->state_living_in==$other_user->state_living_in ?$data['state_living_in']=true:$data['state_living_in']=false);
            ($auth_user['city/district']==$other_user['city/district'] ?$data['city']=true:$data['city']=false);
        }
        $auth_user['image'] = ProfilePicture::where('user_id',Auth::user()->id)->get();

        
        return response()->json(['data'=>['user'=>$user,'auth_user'=>$auth_user,'other_user'=>$other_user,'data'=>$data]]);
    }
    public function getProfiles(Request $request)
    {
        $auth_user =Profile::where('user_id',Auth::user()->id)->first();

        $query = Profile::where('gender',$auth_user->gender=='Male'?'Female':'Male')->with('user')->with('country')->with('sector')->with('city')->with('religion')->with('cast')->with('userSubscription');
        $qualification = Profile::whereNotNull('qualification')->pluck('qualification');

        $income_minimum=0;$income_maximum=0;    
        if($request->days!='' || $request->days!=null){
       
        $days = $request->days;
            $days= (int)$days;
            $date = \Carbon\Carbon::today()->subDays($days);         
            $query->where('created_at', '>=', $date);
        }
        

        if($request->qualification!='' || $request->qualification!=null){
            $query->where('qualification', $request->qualification);
        }
        
        if ($request->has('income')) {
           if($request->income!='' || $request->income!=null){

           
          $income=  explode("-",$request->income);
            if(count($income)==2){

                $income_minimum = $income[0];
                $income_maximum = $income[1];
                
                $query->whereBetween('annual_income', [$income_minimum,$income_maximum]);
            }
}
        }

        
        
    if($request->gender!='' || $request->gender!=null){
            $query->where('gender', $request->gender);
        }
        
        return response()->json([
            ['profiles' => $query->get(),
            $request->income,
            'qualification'=>$qualification],
            $request,
            200,
        ]);
    }
    public function partnerStore(Request $request)
    {
        $data = PartnerPreferences::where('user_id',4)->first();
        if($data==null){
            PartnerPreferences::insert($request->data);
        }else{
            $data->update($request->data);
        }
        
        return response()->json(['data' => $data]);
    }
    public function getPartner(Request $request)
    {
        $data = PartnerPreferences::where('user_id',$request->user_id)->first();
        return response()->json([
            ['partnerPreferences' => $data],
            200,
        ]);
    }

    public function getPartnerMatch(Request $request)
    {
        $auth_user = PartnerPreferences::where('user_id',Auth::user()->id)->first();
        $other_user = PartnerPreferences::where('user_id', $request->user_id)->first();
        ($auth_user['age']==$other_user['age'] ?$data['age']=true:$data['age']=false);
        ($auth_user->height==$other_user->height ?$data['height']=true:$data['height']=false);
        ($auth_user->martial_status==$other_user->martial_status ?$data['martial_status']=true:$data['martial_status']=false);
        ($auth_user->religion==$other_user->religion ?$data['religion']=true:$data['religion']=false);
        ($auth_user->mother_tongue==$other_user->mother_tongue ?$data['mother_tongue']=true:$data['mother_tongue']=false);
        ($auth_user->community==$other_user->community ?$data['community']=true:$data['community']=false);
        ($auth_user->country_living_in ==$other_user->country_living_in ?$data['country_living_in']=true:$data['country_living_in']=false);
        ($auth_user->state_living_in==$other_user->state_living_in ?$data['state_living_in']=true:$data['state_living_in']=false);
        ($auth_user['city/district']==$other_user['city/district'] ?$data['city']=true:$data['city']=false);
        return ($data);
        // return response()->json([
        //     ['partnerPreferences' => $data],
        //     200,
        // ]);
    }

    public function imageStore(Request $request)
    {

        if ($request->hasfile('image')) {
 
          
            ProfilePicture::where('user_id',$request->user_id)->delete();
     
            foreach($request->image as $key => $image) {
        
                $imageName = $request->user_id.'-Profile-'.($key+1).'-'.time().'.'.$image->extension();
                $path = 'images\\'.$imageName;
        
                $image->move(public_path('images'), $imageName);

                  ProfilePicture::insert([
                    'image_name' => $imageName,'image_path' => $path,'user_id'=>$request->user_id
                ]);
            }
         }

        // $name = $request->user_id.'-Profile'.time();
        // $imageName = $name.'.'.$request->image->extension();  

        // $request->image->move(public_path('images'), $imageName);
        // $path = 'images\\'.$imageName;
        
        // $imageDB = ProfilePicture::where('user_id',$request->user_id)->first();
        // if($imageDB)
        // {
        //     $imageDB->update([ 
        //         'image_name' => $imageName,'image_path' => $path
        //         ]);
        // }else{
        //     $imageDB = ProfilePicture::insert([
        //         'image_name' => $imageName,'image_path' => $path,'user_id'=>$request->user_id
        //     ]);
        // }
        
        $data = ProfilePicture::where('user_id',$request->user_id)->get();
        return response()->json([
            ['addedProfilePictures' => $data],
            200,
        ]);
    }
    public function getImages(Request $request)
    {
        $data = ProfilePicture::where('user_id',$request->user_id)->first();
        return response()->json([
            ['ProfilePictures' => $data],
            200,
        ]);
    }
    public function pictureSettings(Request $request)
    {
        $update = false;
        $data = Profile::where('user_id',Auth::user()->id)->first();
        if(isset($request->pictures_settings)){
            $data->update(['pictures_settings'=>$request->pictures_settings]);
            $update = true;
        }
        $data = Profile::where('user_id',Auth::user()->id)->first();
        return [$data,$update];
    }
    public function search(Request $request)
    {

        // $posts = app(Pipeline::class)
        //         ->send(Profile::with('country')->with('state')->with('sector')->with('city')->with('religion')->with('cast')->with('user'))
        //         ->through([
        //             \App\QueryFilters\Status::class,
        //             \App\QueryFilters\OrderBy::class,
        //         ])
        //         ->thenReturn()
        //         ->get();
        // return view('post.index', compact('posts'));
    }
    public function contactView(Request $request)
    {
        $authUser = Profile::where('user_id',Auth::user()->id)->with('user')->first();
        $authUser->update(['view_contacts'=>(((int)$authUser->profile_viewed)+1)]);

        return [$authUser->number,$authUser->user->email];
    }
    public function profileStat(Request $request)
    {
        $stats = Profile::where('user_id',Auth::user()->id)->with('user')->first();
        $profileViewedYou = $stats->user->profileViewedYou->count();
        $profileYouViewed = $stats->user->profileYouViewed->count();
        $contact = $stats->contact_no;
        return ['contact'=>$contact,'profileYouViewed'=>$profileYouViewed,'profileViewedYou'=>$profileViewedYou];
    }

}
