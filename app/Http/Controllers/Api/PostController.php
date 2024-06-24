<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tag = $request->query('tag');

        $posts = Post::with('tags')
            ->when($tag, function ($query) use ($tag) {
                $query->whereHas('tags', function ($query) use ($tag) {
                    $query->where('name', $tag);
                });
            })
            ->orderBy('created_at', 'desc')->paginate(10);

        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $tags = $request->input('tags', []);

        $tagIds = [];
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $post = Post::create($request->only('title', 'content', 'author_id'));

        $post->tags()->sync($tagIds);

        return $post->load('tags');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $post = Post::with('tags')->findOrFail($request->route('ID'));

        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = Post::findOrFail($request->route('ID'));

        $post->update($request->only('title', 'body', 'content'));

        $tags = $request->input('tags', []);
        $tagIds = [];
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $post->tags()->sync($tagIds);

        $post->load('tags');

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return Post::destroy($request->route('ID'));
    }
}
