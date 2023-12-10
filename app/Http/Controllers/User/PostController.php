<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\PostsCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Film;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::query()
            ->where('user_id', Auth::id())
            ->join('posts_categories', 'posts_categories.id', '=', 'category_id')
            ->join('films', 'films.id', '=', 'film_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10, [
                'posts.id as id', 
                'title', 
                'posts_categories.name as category', 
                'films.name as film', 
                'posts.created_at as created_at', 
                'posts.published_at as published_at', 
                'active']);

        return view('user.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $films = Film::query()->get();
        $categories = PostsCategories::query()->get();

        return view('user.posts.create', compact(['films', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'category' => ['required', 'integer'],
            'film' => ['required', 'integer']
        ]);

        $post = Post::query()->create([
            'title' => $validated['title'],
            'category_id' => $validated['category'],
            'film_id' => $validated['film'],
            'content' => $validated['content'],
            'user_id' => Auth::id(),
            'active' => true,
            'published_at' => Carbon::now()
        ]);

        alert(__('Статья создана'));
        return redirect()->route('user.posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $post_id)
    {
        $post = Post::query()
            ->join('posts_categories', 'posts_categories.id', '=', 'posts.category_id')
            ->join('films', 'films.id', '=', 'posts.film_id')
            ->where('posts.id', $post_id)
            ->findOrFail($post_id, [
                '*',
                'posts.id as id',
                'posts.created_at as created_at',
                'posts.updated_at as updated_at',
                'posts_categories.name as category', 
                'films.id as film_id', 
                'films.name as film'
            ]);

        $comments = Comment::query()
            ->where('post_id', $post_id)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->get(['comments.text', 'users.login as user']);

        return view('user.posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($post)
    {
        $post = Post::query()->findOrFail($post);

        $films = Film::query()->get();
        $categories = PostsCategories::query()->get();

        return view('user.posts.edit', compact(['post', 'films', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $post)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'category' => ['required'],
            'film' => ['required']
        ]);

        Post::query()
            ->where('id', $post)
            ->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'category_id' => $validated['category'],
                'film_id' => $validated['film']
            ]);

        alert(__('Изменения сохранены'));
        return redirect()->route('user.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $post)
    {
        Post::query()
            ->where('id', $post)
            ->delete();
        
        alert(__('Статья удалена'));
        return redirect()->route('user.posts');
    }
}
