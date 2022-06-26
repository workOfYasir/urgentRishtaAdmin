<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsComment;
use App\Models\NewsLike;
use App\Models\Post;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
class NewsController extends Controller
{
    public function index(){
        $news=News::with('newsable')->get();
        $user_id=Auth::user()->id;
        foreach($news as $key=>$media){
            
            $like= NewsLike::where('news_id',$media->id)->where('user_id',$user_id)->exists();
            
            $model = new $media->model_type;
            $news= $model->find($media->model_id);
            if($media->model_type !='App\Models\Post'){
                $b=$model->find($media->model_id);
                $newschild=$b->relation()->get(); 
            }   
            $input['news'.$key]=[
                'news_id'=>$media->id,
                'news'=>$news,
                'news_child'=>$newschild,
                'like'=>$like
            ];
            
        }
        return ['OK'=>$input];
    }

    /**
     * Comments Fetch post
     */
    public function comments($id){
        $comments=NewsComment::where('news_id',$id)->with('user')->get();
        return response()->json(['comments'=>$comments]);
    }
    /**
     * Store Comment
     */
    public function storeComments(Request $request){
        $input=$request->all();
        $input['user_id']=Auth::user()->id;
        $comments=NewsComment::create($input);
        return response()->json('Added',200);
    }

    /**
     * Store lIKE
     */
    public function storeLikes(Request $request){
        $input=$request->all();
        $input['user_id']=Auth::user()->id;
        $comments=NewsLike::create($input);
        return response()->json('Added',200);
    }

    /**Store Post */
    public function storePost(Request $request){
        $validator = Validator::make($request->all(), [ 
            'description' => 'required|max:500', 
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
        
        $post=new Post();
        $post->description=$request->description;
        if($request->has('image')){
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('postImages'), $imageName);
            $post->image='postImages'.'/'.$imageName;
        }
       
        $post->save();
        News::create([
            'model_type'=>'App\Models\Post',
            'model_id'=>$post->id,
        ]);
        return response()->json('Added',200);
    }
}
