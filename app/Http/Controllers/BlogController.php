<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostsCategories;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function index(Request $request) {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'from_date' => ['nullable', 'string', 'date'],
            'to_date' => ['nullable', 'string', 'date', 'after:from_date'],
        ]);

        $query = Post::query();

        // <Запросы для фильтров>
        if($search = $validated['search'] ?? null) {
            $query->where(function(Builder $query) use ($search) {
                $query
                    ->where('posts.title', 'like', "%{$search}%")
                    ->orWhere('users.login', 'like', "%{$search}%");
            });
        }

        if ($fromDate = $validated['from_date'] ?? null) {
            $query->where('posts.published_at', '>=', new Carbon($fromDate));
        }

        if ($toDate = $validated['to_date'] ?? null) {
            $query->where('posts.published_at', '<=', new Carbon($toDate));
        }

        if($category_id = $request->category_id ?? null) {
            $query->where('posts.category_id', '=', $category_id);
        }
        // <Запросы для фильтров />

        $posts = $query
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('posts_categories', 'posts_categories.id', '=', 'category_id')
            ->join('films', 'films.id', '=', 'film_id')
            ->where('posts.active', '=', true)
            ->whereNotNull('posts.published_at')
            ->orderBy('posts.published_at', 'desc')
            ->paginate(10, [
                'posts.id', 
                'posts.title', 
                'posts_categories.name as category', 
                'films.name as film',
                'posts.published_at', 
                'posts.active', 
                'users.login as user_login',
            ]);

        $categories = PostsCategories::query()->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(string $post_id)
    {
        $post = Post::query()
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('posts_categories', 'posts_categories.id', '=', 'posts.category_id')
            ->join('films', 'films.id', '=', 'posts.film_id')
            ->where('posts.id', $post_id)
            ->findOrFail($post_id, [
                '*', 
                'posts.id as id', 
                'users.login as user', 
                'posts_categories.name as category', 
                'films.id as film_id', 
                'films.name as film'
            ]);

        $comments = Comment::query()
            ->where('post_id', $post_id)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->paginate(10, ['comments.id', 'comments.text', 'users.login as user', 'comments.commented_at']);

        return view('blog.show', compact(['post', 'comments']));
    }
}
