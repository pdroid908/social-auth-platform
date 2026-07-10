<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $like = Like::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if ($like) {

            $like->delete();

            return back()->with('success', '');
        }

        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return back()->with('success', '');
    }
}