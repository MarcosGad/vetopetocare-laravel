<?php
   
namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Comment;
use DB;

   
class CommentsController extends BaseController
{
   
   public function getPost($id,$type){
    	$posts = DB::table('posts')
    			->join('users', 'users.id', '=', 'posts.userid')
                ->select('posts.id as postid', 'posts.*', 'users.id as userid', 'users.*')
                ->where([['itemid','=',$id],['typee','=', $type]])
    			->orderBy('posts.created_at', 'desc')
                ->get();          
		$success['posts'] = $posts;
        return $this->sendResponse($success, 'Posts Get Done.');
    }
    
    public function getComment($postId){
        $comments = DB::table('comments')
                    ->join('users', 'users.id', '=', 'comments.userid')
                    ->select('comments.id as commentid', 'comments.*', 'users.id as userid', 'users.*')
                    ->where('postid', '=', $postId)
                    ->get();
        $success['comments'] = $comments;
        return $this->sendResponse($success, 'Comments Get Done.');
    }
    
    public function post(Request $request){
    		$user = Auth::user();
            $post = new Post;
	    	$post->userid = $user->id;
            $post->post = $request->input('post');
            $post->itemid = $request->input('id');
            $post->typee = $request->typee;
	  		$post->save();
            $success['post'] = $post;
            return $this->sendResponse($success, 'Post Insert Done.');
    }
    
    public function makeComment(Request $request){
            $user = Auth::user();
            $comment = new Comment;
            $comment->userid = $user->id;
            $comment->postid = $request->postid;
            $comment->comment = $request->commenttext;
            $comment->save();
            $success['comment'] = $comment;
            return $this->sendResponse($success, 'Comment Insert Done.');
    }
    
    
}