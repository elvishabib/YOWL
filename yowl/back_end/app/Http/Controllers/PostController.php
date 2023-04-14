<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{


    public function index()
    {
        $posts = Post::all();
        return $posts;
    }

    public function create(Request $request)
    {

        $url = $request->input('url');
        if (empty($url)) {
            return response()->json([
                'error' => 'Please enter a URL.',
            ], 400);
        }
        try {
            $client = new Client();
            $response = $client->request('GET', $url);

            $html = $response->getBody()->getContents();

            preg_match('/<title>(.*?)<\/title>/', $html, $matches);
            $title = isset($matches[1]) ? $matches[1] : '';

            preg_match('/<meta.*?property="og:image".*?content="(.*?)".*?>/s', $html, $matches);
            $image = isset($matches[1]) ? $matches[1] : '';

            // return response()->json([
            //     'title' => $title,
            //     'image' => $image,
            // ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Could not retrieve metadata for the given URL.',
            ], 404);
        }
        // $request->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        //     'url' => 'required',
        //     'image' => 'required'
        // ]);
        $token = $request->token;
        $user = User::where('token', $token)->first();
        $user_id = $user->id;
        $username = $user->username;
        $post = new Post;
        $post = [
            'title' => $title, 'content' => $request->content,
            'url' => $request->url, 'image' => $image, 'user_id' => $user_id, 'username' => $username
        ];

        Post::create($post);
        return $post;
    }

    public function show_from_user(Request $request)
    {
        $token = $request->token;
        $user = User::where('token', $token)->first();
        $user_id = $user->id;
        $post = Post::all()->where('user_id', $user_id)->sortByDesc('updated_at');
        return $post;
    }

    public function show($id)
    {
        $post = Post::find($id);
        return $post;
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->statut = 1;
        $post->save();
        return $post;
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->content = $request->get('content');
        $post->save();
        return $post;
    }


    public function count()
    {
        $count = Post::all()->count();
        return $count;
    }

    // public function likes($id)
    // {
    //     $post = Post::find($id);
    //     $post->likes += 1;
    //     $post->save();
    //     return $post;
    // }

    // public function unlikes($id)
    // {
    //     $post = Post::find($id);
    //     $post->unlikes += 1;
    //     $post->save();
    //     return $post;
    // }

    /*  public function getMetaD(Request $request)
    {
        $url = $request->input('url');
        try {
        $client = new Client();
        $response = $client->request('GET', $url);

        $html = $response->getBody()->getContents();

        preg_match('/<title>(.*?)<\/title>/', $html, $matches);
        $title = isset($matches[1]) ? $matches[1] : '';

        preg_match('/<meta.*?property="og:image".*?content="(.*?)".*?>/s', $html, $matches);
        $image = isset($matches[1]) ? $matches[1] : '';

        return response()->json([
            'title' => $title,
            'image' => $image,
        ]);
        } catch (\Exception $e) {
        return response()->json([
            'error' => 'Could not retrieve metadata for the given URL.',
        ], 404);
    }
    }*/


    public function search(Request $request)
    {
        $keyword = $request->input('search');

        $results = DB::table('posts')
            ->whereRaw('LOWER(title) LIKE', ["%$keyword%"])
            ->orWhereRaw('LOWER(content) LIKE', ["%$keyword%"])
            ->get();

        return $results;
    }
}
