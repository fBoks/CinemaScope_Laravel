<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request, string $post_id) {
        $post = Post::query()->findOrFail($post_id);

        return view('user.posts.comments.create', compact('post'));
    }

    public function store(Request $request, string $post_id)
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:300'],
        ]); 

        Comment::query()->create([
                'post_id' => $post_id,
                'user_id' => Auth::id(),
                'text' => $validated['comment'],
                'commented_at' => Carbon::now()
            ]);

        return redirect()->route('blog.show', $post_id);
    }

    public function show(string $post_id, string $comment_id) {
        $post = Post::query()->findOrFail($post_id);
        
        $comment = Comment::query()
            ->where('comments.id', $comment_id)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->get([
                'comments.id as id',
                'comments.text as text',
                'comments.commented_at as commented_at',
                'comments.user_id as user_id',
                'users.login as login'
            ])[0];

        return view('user.posts.comments.show', compact(['post', 'comment']));
    }

    public function delete(string $post_id, string $comment_id) {
        Comment::query()
            ->where('id', $comment_id)
            ->delete();
        
        return redirect()->route('blog.show', $post_id);
    }
}
