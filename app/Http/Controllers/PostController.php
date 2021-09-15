<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Post;
use App\Comment;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['post','makeComment']]);
    }

    public function getPost($id,$type){
    	$posts = DB::table('posts')
    			->join('users', 'users.id', '=', 'posts.userid')
                ->select('posts.id as postid', 'posts.*', 'users.id as userid', 'users.*')
                ->where([['itemid','=',$id],['typee','=', $type]])
    			->orderBy('posts.created_at', 'desc')
                ->get();          
		return view('front.postlist', compact('posts'));
    }
 
    public function post(Request $request){
    	if ($request->ajax()){
    		$user = Auth::user();
            $post = new Post;
	    	$post->userid = $user->id;
            $post->post = $request->input('post');
            $post->itemid = $request->input('id');
            $post->typee = $request->typee;
	  		$post->save();
            return response($post);
        }
    }


    public function getComment(Request $request){
        if ($request->ajax()){
           $comments = DB::table('comments')
                    ->join('users', 'users.id', '=', 'comments.userid')
                    ->select('comments.id as commentid', 'comments.*', 'users.id as userid', 'users.*')
                    ->where('postid', '=', $request->id)
                    ->get();
 
            return view('front.commentlist', compact('comments'));
        }
    }
 
    public function makeComment(Request $request){
        if ($request->ajax()){
            $user = Auth::user();
            $comment = new Comment;
            $comment->userid = $user->id;
            $comment->postid = $request->postid;
            $comment->comment = $request->commenttext;
            $comment->save();
            return response($comment);
        }
    }
}