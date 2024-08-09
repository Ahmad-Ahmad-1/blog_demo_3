<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\PostStoreRequest;
use App\Http\Requests\Api\Post\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller implements HasMiddleware
{
    public function index()
    {
        // session(['redirect-posts-route' => 'posts.index']);

        $posts = Post::latest()->paginate(5);

        return response()->json([
            'posts' => PostResource::collection($posts),
            'current_page' => $posts->currentPage(),
            // 'redirect-posts-route' => session()->get('redirect-posts-route')
        ]);
    }

    public function latestPosts()
    {
        // session(['redirect-posts-route' => 'home']);

        $posts = Post::latest()->limit(8)->get();

        return response()->json([
            'posts' => PostResource::collection($posts),
            // 'redirect-posts-route' => session()->get('redirect-posts-route')
        ]);
    }

    public function myPosts()
    {
        // session(['redirect-posts-route' => 'posts.my_posts']);

        $posts = Post::where('user_id', '=', auth()->user()->id)->latest()->paginate(5);

        return response()->json([
            'posts' => PostResource::collection($posts),
            'current_page' => $posts->currentPage(),
            // 'redirect-posts-route' => session()->get('redirect-posts-route')
        ]);
    }

    // public function create()
    // {
    //     return view('posts.create');
    // }

    public function store(PostStoreRequest $request)
    {
        $post = Post::create($request->safe()->except('img'));

        if ($request->hasFile('img')) {
            $post->addMediaFromRequest('img')
                ->withResponsiveImages()
                ->usingName($post->title)
                ->toMediaCollection('imgs');
        }

        return response()->json([
            'post' => [new PostResource($post)]
        ]);
    }

    public function show(Post $post)
    {
        return response()->json([
            'post' => new PostResource($post),
        ]);

        // return view('posts.show');
    }

    public function edit(Post $post)
    {
        return response()->json([
            'post' => new PostResource($post)
        ]);
    }

    public function update(Post $post, PostUpdateRequest $request)
    {
        $post->update($request->safe()->except('img'));

        if ($request->hasFile('img')) {
            $post->clearMediaCollection('imgs');

            $post->addMediaFromRequest('img')
                ->withResponsiveImages()
                ->usingName($post->title)
                ->toMediaCollection('imgs');
        }

        // to be implemented
        // else {
        //     $post->deleteMedia('imgs');
        // }

        return response()->json([
            'post' => new PostResource($post)
        ]);

        // return to_route('posts.show', [$post->id])->with('status', 'Post Updated Successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'post has been deleted successfully'
        ]);

        // return to_route(session('redirect-posts-route'))->with('status', 'Post has been deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::where('title', 'like', "%$search%")->paginate(5);

        return response()->json([
            'posts' => PostResource::collection($posts),
            'current_page' => $posts->currentPage(),
        ]);
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:Create Post', only: ['create', 'store', 'myPosts']),
            new Middleware('permission:Edit Post', only: ['edit', 'update']),
            new Middleware('permission:Delete Post', only: ['destroy']),
        ];
    }
}
