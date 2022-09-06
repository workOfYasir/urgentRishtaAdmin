<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Models\Profile;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\ProfilePicture;
use App\Models\PartnerPreferences;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public $array = [];
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
        $data = Profile::where('user_id', Auth::user()->id);
        $user = User::where('id', Auth::user()->id);
        if($request->user!=null){
            $user->update($request->user);
        }
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
        $user = Profile::where('user_id', ($request->user_id == null ? Auth::user()->id : $request->user_id))->with('country')->with('state')->with('sector')->with('city')->with('religion')->with('cast')->with('user')->get();

        $auth_user = PartnerPreferences::where('user_id', Auth::user()->id)->first();
        $other_user = PartnerPreferences::where('user_id', $request->user_id)->first();
        if ($auth_user == null || $other_user == null) {
            $data['age'] = false;
            $data['height'] = false;
            $data['religion'] = false;
            $data['mother_tongue'] = false;
            $data['marital_status'] = false;
            $data['community'] = false;
            $data['country_living_in'] = false;
            $data['city'] = false;
            $data['state_living_in'] = false;
            $data['city'] = false;
        } else {
            ($auth_user->age == $other_user->age ? $data['age'] = true : $data['age'] = false);
            ($auth_user->height == $other_user->height ? $data['height'] = true : $data['height'] = false);
            ($auth_user->marital_status == $other_user->marital_status ? $data['marital_status'] = true : $data['marital_status'] = false);
            ($auth_user->religion == $other_user->religion ? $data['religion'] = true : $data['religion'] = false);
            ($auth_user->mother_tongue == $other_user->mother_tongue ? $data['mother_tongue'] = true : $data['mother_tongue'] = false);
            ($auth_user->community == $other_user->community ? $data['community'] = true : $data['community'] = false);
            ($auth_user->country_living_in == $other_user->country_living_in ? $data['country_living_in'] = true : $data['country_living_in'] = false);
            ($auth_user->state_living_in == $other_user->state_living_in ? $data['state_living_in'] = true : $data['state_living_in'] = false);
            ($auth_user['city/district'] == $other_user['city/district'] ? $data['city'] = true : $data['city'] = false);
        }
        $auth_user['image'] = ProfilePicture::where('user_id', Auth::user()->id)->get();


        return response()->json(['data' => ['user' => $user, 'auth_user' => $auth_user, 'other_user' => $other_user, 'data' => $data]]);
    }

public function picture()
{
    return ProfilePicture::where('user_id', Auth::user()->id)->first();
}
public function getNewProfiles(Request $request)
{

    $auth_user = Profile::where('user_id', Auth::user()->id)->first();

    $query = Profile::where('gender', $auth_user->gender == 'Male' ? 'Female' : 'Male')->with('user')->with('country')->with('sector')->with('city')->with('religion')->with('cast')->with('userSubscription');
    $qualification = Profile::whereNotNull('qualification')->pluck('qualification');

    $income_minimum = 0;
    $income_maximum = 0;
    $height_minimum = 0;
    $height_maximum = 0;

    if(@$request->country != '' || @$request->country !=null){
        $query->where('country_id', @$request->country); 
    }
    if(@$request->state != '' || @$request->state !=null){
        $query->where('state_id', @$request->state);
    }
    if(@$request->city != '' || @$request->city !=null){
        $query->where('city_id', @$request->city);
    }
    if(@$request->religion != '' || @$request->religion !=null){
        $query->where('religion_id', @$request->religion);
    }
    if(@$request->sector != '' || @$request->sector !=null){
        $query->where('sector_id', @$request->sector);
    }
    if(@$request->cast != '' || @$request->cast !=null){
        $query->where('cast_id', @$request->cast);
    }
    if ($request->days != '' || $request->days != null) {

        $days = $request->days;
        $days = (int)$days;
        $date = \Carbon\Carbon::today()->subDays($days);
        $query->where('created_at', '>=', $date);
    }


    if ($request->qualification != '' || $request->qualification != null) {
        $query->where('qualification', $request->qualification);
    }

    if ($request->has('income')) {
        if ($request->income != '' || $request->income != null) {


            $income =  explode("-", $request->income);
            if (count($income) == 2) {

                $income_minimum = $income[0];
                $income_maximum = $income[1];

                $query->whereBetween('annual_income', [$income_minimum, $income_maximum]);
            }
        }
    }
    if ($request->has('height')) {
        if ($request->height != '' || $request->height != null) {


            $height =  explode("-", $request->height);
            if (count($height) == 2) {

                $height_minimum = $height[0];
                $height_maximum = $height[1];

                $query->whereBetween('height', [$height_minimum, $height_maximum]);
            }
        }
    }

    if ($request->working_with != '' || $request->working_with != null) {
        $query->where('working_with', $request->working_with);
    }
    if ($request->blood_group != '' || $request->blood_group != null) {
        $query->where('blood_group', $request->blood_group);
    }

    if ($request->on_behalf != '' || $request->on_behalf != null) {
        $query->where('on_behalf', $request->on_behalf);
    }



    // if($request->gender!='' || $request->gender!=null){
    //         $query->where('gender', $request->gender);
    //     }

    return response()->json([
        [
            'profiles' => $query->orderBy('id', 'DESC')->get(),
            $request->income,
            'qualification' => $qualification
        ],
        $request,
        200,
    ]);
}    

    public function getProfiles(Request $request)
    {   

        $auth_user = Profile::where('user_id', Auth::user()->id)->first();

        $query = Profile::where('gender', $auth_user->gender == 'Male' ? 'Female' : 'Male')->with('user')->with('country')->with('sector')->with('city')->with('religion')->with('cast')->with('userSubscription');
        $qualification = Profile::whereNotNull('qualification')->pluck('qualification');

        $income_minimum = 0;
        $income_maximum = 0;
        $height_minimum = 0;
        $height_maximum = 0;

        if(@$request->country != '' || @$request->country !=null){
            $query->where('country_id', @$request->country); 
        }
        if(@$request->state != '' || @$request->state !=null){
            $query->where('state_id', @$request->state);
        }
        if(@$request->city != '' || @$request->city !=null){
            $query->where('city_id', @$request->city);
        }
        if(@$request->religion != '' || @$request->religion !=null){
            $query->where('religion_id', @$request->religion);
        }
        if(@$request->sector != '' || @$request->sector !=null){
            $query->where('sector_id', @$request->sector);
        }
        if(@$request->cast != '' || @$request->cast !=null){
            $query->where('cast_id', @$request->cast);
        }


        if (@$request->days != '' || $request->days != null) {

            $days = $request->days;
            $days = (int)$days;
            $date = \Carbon\Carbon::today()->subDays($days);
            $query->where('created_at', '>=', $date);
        }


        if (@$request->qualification != '' || @$request->qualification != null) {
     
            $query->where('qualification', @$request->qualification);
        }

        if (@$request->income != '' || @$request->income != null) {



                $income =  explode("-", @$request->income);
                if (count($income) == 2) {

                    $income_minimum = $income[0];
                    $income_maximum = $income[1];

                    $query->whereBetween('annual_income', [$income_minimum, $income_maximum]);
                }
        }
        if (@$request->height != '' || @$request->height != null) {

                $height =  explode("-", @$request->height);
                if (count($height) == 2) {

                    $height_minimum = $height[0];
                    $height_maximum = $height[1];

                    $query->whereBetween('height', [$height_minimum, $height_maximum]);
                }
            
        }

        if (@$request->working_with != '' || @$request->working_with != null) {
            $query->where('working_with', @$request->working_with);
        }
        if (@$request->blood_group != '' || @$request->blood_group != null) {
 
            $query->where('blood_group', @$request->blood_group);
        }

        if (@$request->on_behalf != '' || @$request->on_behalf != null) {

            $query->where('on_behalf', @$request->on_behalf);
        }

        if($request->gender!='' || $request->gender!=null){
 
            $query->where('gender', $request->gender);
            }


        return response()->json([
            [
                'profiles' => $query->get(),
                'qualification' => $qualification
            ],
            200,
        ]);
    }
    public function getSearchedProfiles(Request $request)
    {
        $auth_user = Profile::where('user_id', Auth::user()->id)->first();

        $query = Profile::where('gender', $auth_user->gender == 'Male' ? 'Female' : 'Male')->with('user')->with('country')->with('sector')->with('city')->with('religion')->with('cast')->with('userSubscription')->inRandomOrder()->limit(1)->get();
        $qualification = Profile::whereNotNull('qualification')->pluck('qualification');

        return response()->json([
            [
                'profiles' => $query,
                @$request->income,
                'qualification' => $qualification
            ],
            $request,
            200,
        ]);
    }
    public function getProfilesMatches(Request $request)
    {

        $auth_user = Profile::where('user_id', Auth::user()->id)->first();

        $query = Profile::where('gender', $auth_user->gender == 'Male' ? 'Female' : 'Male')->with('user')->with('country')->with('sector')->with('city')->with('religion')->with('cast')->with('userSubscription');
        $qualification = Profile::whereNotNull('qualification')->pluck('qualification');

        $income_minimum = 0;
        $income_maximum = 0;
        $height_minimum = 0;
        $height_maximum = 0;

        if ($request->days != '' || $request->days != null) {

            $days = $request->days;
            $days = (int)$days;
            $date = \Carbon\Carbon::today()->subDays($days);
            $query->where('created_at', '>=', $date);
        }


        if ($request->qualification != '' || $request->qualification != null) {
            $query->where('qualification', $request->qualification);
        }

        if ($request->has('income')) {
            if ($request->income != '' || $request->income != null) {


                $income =  explode("-", $request->income);
                if (count($income) == 2) {

                    $income_minimum = $income[0];
                    $income_maximum = $income[1];

                    $query->whereBetween('annual_income', [$income_minimum, $income_maximum]);
                }
            }
        }
        if ($request->has('height')) {
            if ($request->height != '' || $request->height != null) {


                $height =  explode("-", $request->height);
                if (count($height) == 2) {

                    $height_minimum = $height[0];
                    $height_maximum = $height[1];

                    $query->whereBetween('height', [$height_minimum, $height_maximum]);
                }
            }
        }

        if ($request->working_with != '' || $request->working_with != null) {
            $query->where('working_with', $request->working_with);
        }
        if ($request->blood_group != '' || $request->blood_group != null) {
            $query->where('blood_group', $request->blood_group);
        }

        if ($request->on_behalf != '' || $request->on_behalf != null) {
            $query->where('on_behalf', $request->on_behalf);
        }
        if ($request->marital_status != '' || $request->marital_status != null) {
            $query->where('marital_status', $request->marital_status);
        }
        
        return response()->json([
            [
                'profiles' => $query->skip(0)->take(10)->get(),
                $request->marital_status,
                'qualification' => $qualification
            ],
            $request,
            200,
        ]);
    }

    public function partnerStore(Request $request)
    {
        $data = PartnerPreferences::where('user_id', 4)->first();
        if ($data == null) {
            PartnerPreferences::insert($request->data);
        } else {
            $data->update($request->data);
        }
        return response()->json(['data' => $data]);
    }
    public function getPartner(Request $request)
    {
        $data = PartnerPreferences::where('user_id', $request->user_id)->first();
        return response()->json([
            ['partnerPreferences' => $data],
            200,
        ]);
    }

    public function getPartnerMatch(Request $request)
    {
        $auth_user = PartnerPreferences::where('user_id', Auth::user()->id)->first();
        $other_user = PartnerPreferences::where('user_id', $request->user_id)->first();
        ($auth_user['age'] == $other_user['age'] ? $data['age'] = true : $data['age'] = false);
        ($auth_user->height == $other_user->height ? $data['height'] = true : $data['height'] = false);
        ($auth_user->marital_status == $other_user->marital_status ? $data['marital_status'] = true : $data['marital_status'] = false);
        ($auth_user->religion == $other_user->religion ? $data['religion'] = true : $data['religion'] = false);
        ($auth_user->mother_tongue == $other_user->mother_tongue ? $data['mother_tongue'] = true : $data['mother_tongue'] = false);
        ($auth_user->community == $other_user->community ? $data['community'] = true : $data['community'] = false);
        ($auth_user->country_living_in == $other_user->country_living_in ? $data['country_living_in'] = true : $data['country_living_in'] = false);
        ($auth_user->state_living_in == $other_user->state_living_in ? $data['state_living_in'] = true : $data['state_living_in'] = false);
        ($auth_user['city/district'] == $other_user['city/district'] ? $data['city'] = true : $data['city'] = false);
        return ($data);
        // return response()->json([
        //     ['partnerPreferences' => $data],
        //     200,
        // ]);
    }

    public function imageStore(Request $request)
    {

        if ($request->hasfile('image')) {

            ProfilePicture::where('user_id', $request->user_id)->delete();

            foreach ($request->image as $key => $image) {

                $imageName = $request->user_id . '-Profile-' . ($key + 1) . '-' . time() . '.' . $image->extension();
                $path = 'images\\' . $imageName;

                $image->move(public_path('images'), $imageName);

                ProfilePicture::insert([
                    'image_name' => $imageName, 'image_path' => $path, 'user_id' => $request->user_id
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

        $data = ProfilePicture::where('user_id', $request->user_id)->get();
        return response()->json([
            ['addedProfilePictures' => $data],
            200,
        ]);
    }
    public function getImages(Request $request)
    {
        $data = ProfilePicture::where('user_id', $request->user_id)->first();
        return response()->json([
            ['ProfilePictures' => $data],
            200,
        ]);
    }
    public function pictureSettings(Request $request)
    {
        $update = false;
        $data = Profile::where('user_id', Auth::user()->id)->first();
        if (isset($request->pictures_settings)) {
            $data->update(['pictures_settings' => $request->pictures_settings]);
            $update = true;
        }
        $data = Profile::where('user_id', Auth::user()->id)->first();
        return [$data, $update];
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
        $authUser = Profile::where('user_id', Auth::user()->id)->with('user')->first();
        $authUser->update(['view_contacts' => (((int)$authUser->profile_viewed) + 1)]);

        return [$authUser->whatsapp_number, $authUser->user->email];
    }
    public function profileStat(Request $request)
    {
        $stats = Profile::where('user_id', Auth::user()->id)->with('user')->first();
        $profileViewedYou = $stats->user->profileViewedYou->count();
        $profileYouViewed = $stats->user->profileYouViewed->count();
        $contact = $stats->view_contacts;
        return ['contact' => $contact, 'profileYouViewed' => $profileYouViewed, 'profileViewedYou' => $profileViewedYou];
    }
    public function age()
    {
       $date =  Profile::where('user_id',Auth::user()->id)->pluck('date_of_Birth');
       $date = strtotime('2000-Jan-02');
       $date = date('Y-M-d', $date);
       $date = Carbon::parse($date)->format('Y-M-d');
       return Carbon::parse($date)->age;
          //createFromFormat('Y-M-d', $date)->format('Y-M-d');
       //parse($date);
    }
    public function birth()
    {
        $date =  Profile::where('user_id',Auth::user()->id)->pluck('date_of_Birth');
        $date = strtotime('2000-Jan-02');
        $date = date('Y-M-d', $date);
        $date = Carbon::parse($date)->format('Y-M-d');
        // $expected_start_date = $expected_year."Jan"."01";
        // $expected_end_date = $expected_year."Dec"."31";
        $age = Carbon::parse($date)->age;
        $expected_age = Carbon::now()->subYear($age);
        $expected_year = $expected_age->year;
        // return [$expected_start_date,$expected_end_date];
        return Profile::where('date_of_Birth', 'like', $expected_year.'%')->get();
          //createFromFormat('Y-M-d', $date)->format('Y-M-d');
       //parse($date);
    }
    
    public function filters()
    {
        $filters = Profile::get();
        $qualification = $filters->whereNotNull('qualification')->unique('qualification')->pluck('qualification');

        $blood_group = $filters->whereNotNull('blood_group')->unique('blood_group')->pluck('blood_group');
        $working_with = $filters->whereNotNull('working_with')->unique('working_with')->pluck('working_with');

        return ['working_with' => $working_with, 'blood_group' => $blood_group,  'qualification' => $qualification];
    }
    public function getBasicSearch(Request $request)
    {   

        $auth_user = Profile::where('user_id', Auth::user()->id)->first();

        $query = Profile::where('gender', $auth_user->gender == 'Male' ? 'Female' : 'Male')->with('user')->with('country')->with('sector')->with('city')->with('religion')->with('cast')->with('userSubscription');
        $qualification = Profile::whereNotNull('qualification')->pluck('qualification');

        // $income_minimum = 0;
        // $income_maximum = 0;
        // $height_minimum = 0;
        // $height_maximum = 0;

        if(@$request->min_age != '' || @$request->max_age !=null || @$request->max_age != '' || @$request->min_age !=null){

            $expected_min_age = Carbon::now()->subYear(@$request->min_age);
            $expected_max_age = Carbon::now()->subYear(@$request->max_age);
            $expected_min_year = $expected_min_age->year;
            $expected_max_year = $expected_max_age->year;

            $expected_dates = []; 
            $period = CarbonPeriod::create($expected_min_year.'-01-01', $expected_max_year.'-12-31');
            foreach ($period as $date) {
                array_push($expected_dates,$date->format('Y-M-d'));
            }
            $query->whereIn('date_of_Birth',$expected_dates);

        }


        if (@$request->min_height != '' || @$request->max_height != null || (@$request->max_height != '' || @$request->min_height != null)) {
            $query->whereBetween('height', [$request->min_height, $request->max_height]);            
        }

        if (@$request->marital_status != '' || @$request->marital_status != null) {     
            $query->where('marital_status', @$request->marital_status);
        }
        if (@$request->country != '' || @$request->country != null) {     
            $query->where('country_id', @$request->country);
        }
        if (@$request->state != '' || @$request->state != null) {     
            $query->where('state_id', @$request->state);
        }
        if (@$request->city != '' || @$request->city != null) {     
            $query->where('city_id', @$request->city);
        }
        if (@$request->sector != '' || @$request->sector != null) {     
            $query->where('sector_id', @$request->sector);
        }
        if (@$request->religion != '' || @$request->religion != null) {     
            $query->where('religion_id', @$request->religion);
        }

        return response()->json([
            [
                'profiles' => $query->get(),
                'qualification' => $qualification
            ],
            200,
        ]);
    }
    public function getAdvanceSearch(Request $request)
    {   
   
        $auth_user = Profile::where('user_id', Auth::user()->id)->first();

        $query = Profile::where('gender', $auth_user->gender == 'Male' ? 'Female' : 'Male')->with('user')->with('country')->with('sector')->with('city')->with('religion')->with('cast')->with('userSubscription');
//    return $query;
        $qualification = Profile::whereNotNull('qualification')->pluck('qualification');

        $income_minimum = 0;
        $income_maximum = 0;
        $height_minimum = 0;
        $height_maximum = 0;

        if(@$request->country != '' || @$request->country !=null){
       // return 'ok1';
            $query->where('country_id', @$request->country); 
        }
        if(@$request->state != '' || @$request->state !=null){
       // return 'ok2';
            $query->where('state_id', @$request->state);
        }
        if(@$request->city != '' || @$request->city !=null){
       // return 'ok3';
            $query->where('city_id', @$request->city);
        }
        if(@$request->religion != '' || @$request->religion !=null){
       // return 'ok4';
            $query->where('religion_id', @$request->religion);
        }
        if(@$request->sector != '' || @$request->sector !=null){
       // return 'ok5';
            $query->where('sector_id', @$request->sector);
        }
        if(@$request->cast != '' || @$request->cast !=null){
       // return 'ok6';
            $query->where('cast_id', @$request->cast);
        }
        if(@$request->first_name != '' || @$request->first_name !=null){
       // return 'ok7';
            $query->where('first_name', @$request->first_name);
        }
        if(@$request->last_name != '' || @$request->last_name !=null){
       // return 'ok8';
            $query->where('last_name', @$request->last_name);
        }
        if(@$request->gender != '' || @$request->gender !=null){
       // return 'ok9';
            $query->where('gender', @$request->gender);
        }
        if(@$request->min_age != '' || @$request->max_age !=null || @$request->max_age != '' || @$request->min_age !=null){
       // return 'ok10';
            
            $expected_min_age = Carbon::now()->subYear(@$request->min_age);
            $expected_max_age = Carbon::now()->subYear(@$request->max_age);
            $expected_min_year = $expected_min_age->year;
            $expected_max_year = $expected_max_age->year;

            $expected_dates = []; 
            $period = CarbonPeriod::create($expected_min_year.'-01-01', $expected_max_year.'-12-31');
            foreach ($period as $date) {
                array_push($expected_dates,$date->format('Y-M-d'));
            }
            $query->whereIn('date_of_Birth',$expected_dates);

        }
        if(@$request->date_of_Birth != '' || @$request->date_of_Birth !=null){
       // return 'ok11';
            $query->where('date_of_Birth', @$request->date_of_Birth);
        }
        if(@$request->marital_status != '' || @$request->marital_status !=null){
       // return 'ok12'.$request->marital_status;
            $query->where('marital_status', @$request->marital_status);
        }

        if(@$request->On_behalf != '' || @$request->On_behalf !=null){
       // return 'ok13';
            $query->where('On_behalf', @$request->On_behalf);
        }
        if(@$request->star != '' || @$request->star !=null){
       // return 'ok14';
            $query->where('star', @$request->star);
        }
        if(@$request->disability != '' || @$request->disability !=null){
       // return 'ok15';
            $query->where('disability', @$request->disability);
        }
        if(@$request->blood_group != '' || @$request->blood_group !=null){
       // return 'ok16';
            $query->where('blood_group', @$request->blood_group);
        }
        if(@$request->current_residency_country != '' || @$request->current_residency_country !=null){
       // return 'ok17';
            $query->where('current_residency_country', @$request->current_residency_country);
        }
        if(@$request->city != '' || @$request->city !=null){
       // return 'ok18';
            $query->where('city', @$request->city);
        }
        if(@$request->town != '' || @$request->town !=null){
       // return 'ok19';
            $query->where('town', @$request->town);
        }
        if(@$request->number != '' || @$request->number !=null){
       // return 'ok20';
            $query->where('number', @$request->number);
        }
        if(@$request->whatsapp_number != '' || @$request->whatsapp_number !=null){
       // return 'ok21';
            $query->where('whatsapp_number', @$request->whatsapp_number);
        }
        if(@$request->hobbies != '' || @$request->hobbies !=null){
       // return 'ok22';
            $query->where('hobbies', @$request->hobbies);
        }
        if(@$request->interest != '' || @$request->interest !=null){
       // return 'ok23';
            $query->where('interest', @$request->interest);
        }
        if(@$request->qualification != '' || @$request->qualification !=null){
       // return 'ok24';
            $query->where('qualification', @$request->qualification);
        }
        if(@$request->working_with != '' || @$request->working_with !=null){
       // return 'ok25';
            $query->where('working_with', @$request->working_with);
        }
        if(@$request->company_name != '' || @$request->company_name !=null){
       // return 'ok26';
            $query->where('company_name', @$request->company_name);
        }
        if(@$request->job != '' || @$request->job !=null){
       // return 'ok27';
            $query->where('job', @$request->job);
        }
        if(@$request->no_of_brothers != '' || @$request->no_of_brothers !=null){
       // return 'ok28';
            $query->where('no_of_brothers', @$request->no_of_brothers);
        }
        if(@$request->no_of_sister != '' || @$request->no_of_sister !=null){
       // return 'ok29';
            $query->where('no_of_sister', @$request->no_of_sister);
        }
        if(@$request->family_type != '' || @$request->family_type !=null){
       // return 'ok30';
            $query->where('family_type', @$request->family_type);
        }
        if(@$request->father_status != '' || @$request->father_status !=null){
       // return 'ok41';
            $query->where('father_status', @$request->father_status);
        }
        if(@$request->mother_status != '' || @$request->mother_status !=null){
       // return 'ok42';
            $query->where('mother_status', @$request->mother_status);
        }
        if(@$request->brother_marital_status != '' || @$request->brother_marital_status !=null){
       // return 'ok43';
            $query->where('brother_marital_status', @$request->brother_marital_status);
        }
        if(@$request->family_address != '' || @$request->family_address !=null){
       // return 'ok44';
            $query->where('family_address', @$request->family_address);
        }
        if(@$request->martial_status != '' || @$request->martial_status !=null){
      
            $query->where('marital_status', $request->martial_status);
     
        }
        if(@$request->living_with_family != '' || @$request->living_with_family !=null){
       // return 'ok46'.$request->living_with_family;
            $query->where('living_with_family', @$request->living_with_family);
        }
        if ($request->has('income')) {
            if ($request->income != '' || $request->income != null) {
    // return 'ok47';
    
                $income =  explode("-", $request->income);
                if (count($income) == 2) {
    
                    $income_minimum = $income[0];
                    $income_maximum = $income[1];
    
                    $query->whereBetween('annual_income', [$income_minimum, $income_maximum]);
                }
            }
        }
        if (@$request->has('height')) {
            // return 'ok48';
            if (@$request->height != '' || @$request->height != null) {
    
    
                $height =  explode("-", $request->height);
                if (count($height) == 2) {
    
                    $height_minimum = $height[0];
                    $height_maximum = $height[1];
    
                    $query->whereBetween('height', [$height_minimum, $height_maximum]);
                }
            }
        }
        if(@$request->about != '' || @$request->about !=null){
            // return 'ok49';
            $query->where('about', @$request->about);
        }
        if(@$request->profile_viewed != '' || @$request->profile_viewed !=null){
            // return 'ok50';
            $query->where('profile_viewed', @$request->profile_viewed);
        }
        if(@$request->view_contacts != '' || @$request->view_contacts !=null){
          // return 'ok51';
            $query->where('view_contacts', @$request->view_contacts);
        }
        if(@$request->pictures_settings != '' || @$request->pictures_settings !=null){
         // return 'ok52';
            $query->where('pictures_settings', @$request->pictures_settings);
        }

        // if (@$request->marital_status != '' || @$request->marital_status != null) {     
        //     $query->where('marital_status', @$request->marital_status);
        // }
        // if (@$request->country != '' || @$request->country != null) {     
        //     $query->where('country_id', @$request->country);
        // }
        // if (@$request->state != '' || @$request->state != null) {     
        //     $query->where('state_id', @$request->state);
        // }
        // if (@$request->city != '' || @$request->city != null) {     
        //     $query->where('city_id', @$request->city);
        // }
        // if (@$request->sector != '' || @$request->sector != null) {     
        //     $query->where('sector_id', @$request->sector);
        // }
        // if (@$request->religion != '' || @$request->religion != null) {     
        //     $query->where('religion_id', @$request->religion);
        // }

        return response()->json([
            [
                'profiles' => $query->get(),
                'qualification' => $qualification
            ],
            200,
        ]);
    }
    // public function qualification()
    // {
    //    $data = Profile::where('user_id',Auth::user()->id)->distinct()->pluck('qualification');
    //     return response()->json([
    //         [
    //            $data,
    //         ],
    //         200,
    //     ]);
    // }
    
}
