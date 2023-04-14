<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Http\Request;
use APP\Models\User;
use APP\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
  public function addcomment(Request $request, $id)
  {
    request()->validate([
      'content' => 'required'
    ]);
    $token = $request->token;
    $user = User::where('token', $token)->first();
    $user_id = $user->id;
    $username = $user->username;
    $comment = new Comment;
    $comment->user_id = $user_id;
    $comment->post_id = $id;
    $comment->username = $username;
    $comment->content = request('content');
    // $comment->comment = $request->comment;
    // $comment->user()->associate($request->user());
    // $post = Post::find($request->post_id);
    // $post->comments()->save($comment);
    // return back();
    $comment->save();
    return $comment;
  }

  public function show_from_user(Request $request)
  {
    $token = $request->token;
    $user = User::where('token', $token)->first();
    $user_id = $user->id;
    $comment = Comment::all()->where('user_id', $user_id)->sortByDesc('updated_at');
    return $comment;
  }

  public function show($id)
  {
    $comment = Comment::all()->where('post_id', $id)->sortByDesc('updated_at');
    return $comment;
  }

  public function delete($id)
  {
    $comment = Comment::find($id);
    $comment->statut = 1;
    $comment->save();
    return $comment;
  }

  public function update(Request $request, $id)
  {
    $comment = Comment::find($id);
    $comment->content = $request->get('content');
    $comment->save();
    return $comment;
  }

  public function count()
  {
    $count = Comment::all()->count();
    return $count;
  }

  // public function likes($id)
  // {
  //   $comment = Comment::find($id);
  //   $comment->likes += 1;
  //   $comment->save();
  //   return $comment;
  // }

  // public function unlikes($id)
  // {
  //   $comment = Comment::find($id);
  //   $comment->unlikes += 1;
  //   $comment->save();
  //   return $comment;
  // }
}
