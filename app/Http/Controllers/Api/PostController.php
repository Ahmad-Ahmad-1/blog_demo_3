<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::paginate(7);
        return response()->json([
            'status' => true,
            'posts' => $posts
        ]);
    }

    public function test()
    {
        // $cont = "<div style='color: white; background-color:red'>Hello World</div>";
        // return $cont;

        // return 'test';

        // $cont = Post::latest()->first();
        // dd($cont);
        // return $cont;
        // return response()->json([
        //     'cont' => $cont
        // ]);
    }
}
