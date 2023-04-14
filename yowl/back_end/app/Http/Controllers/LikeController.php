<?php

namespace App\Http\Controllers;

session_start();

use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{
    public function likes(Request $request, $id)
    {
        $post = Post::find($id);
        if($post!=null)
            $post_id=$post->id;
        $token = $request->token;
        $user = User::where('token', $token)->first();
        $user_id = $user->id;
        //dd($user_id);
        $likes = Like::where('post_id', $post_id)->first();
        if($likes!=null && $likes->user_id==$user_id){
            if ($likes->like === 1) {
            $likes->like = 0;
            $post->decrement('likes', 1);
            $likes->save();
            $post->save();
        }else
        {
            if ($likes->like === 0) {
            $likes->like = 1;
            $post->increment('likes', 1);
            $likes->save();
            $post->save();
        }
        }
        } else {
            $newLike = new Like([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'like' => 1
            ]);
            $newLike->save();
            $post->increment('likes', 1);
            $post->save();
        }
    }
}
