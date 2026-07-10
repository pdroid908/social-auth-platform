<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with([
        'user',
        'likes'
    ])
    ->withCount('likes')
    ->latest()
    ->get();

    $posts->each(function ($post) {
    $minutesOld = $post->created_at->diffInMinutes(now());

    if ($minutesOld < 60) {
        $post->fake_likes = 0;
    } else {
        mt_srand($post->id);
        $max = mt_rand(20, 300);
        mt_srand();

        // naik bertahap selama 24 jam pertama setelah jam ke-1, lalu stabil di angka max
        $growthMinutes = min($minutesOld - 60, 1440); // cap 24 jam
        $post->fake_likes = (int) round(($growthMinutes / 1440) * $max);
    }
});

        return view('dashboard', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:7000',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', '');
    }


    public function myPosts()
{
    $posts = Post::withCount('likes')
    ->where('user_id', Auth::id())
    ->latest()
    ->get();

    return view('my-posts', compact('posts'));
}

    public function destroy(Post $post)
{
    if ($post->user_id !== Auth::id()) {
        abort(403);
    }

    $post->delete();

    return back()->with('success', '');
}


}