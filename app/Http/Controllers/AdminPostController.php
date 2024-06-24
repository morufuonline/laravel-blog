<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Post;
use App\Models\Comment;
use App\Helpers\GeneralHelper;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function admin_index()
    {
        $search_fields = ['search'];
        $search = GeneralHelper::search("posts", $search_fields);
        $search = $search["search"];
        $all_posts = Post::when($search, function ($query, $search) {
            $query->where('title', 'LIKE', '%' . $search . '%')->orWhere('body', 'LIKE', '%' . $search . '%');
        }, function ($query) {
            $query->orderByDesc("id");
        })
        ->simplePaginate(8);
        $title = "Manage Posts";
        return view('admin.posts.posts', compact('all_posts', 'title'));
    }

    public function admin_posts_search(SearchRequest $request)
    {
        $search_fields = ['search'];
        GeneralHelper::search("posts", $search_fields, 1);
        return redirect('/admin/posts');
    }

    public function admin_create()
    {
        $title = "Create New Post";
        return view('admin.posts.new-post', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function admin_store(PostStoreRequest $request)
    {
        $data = $request->all();
        $data["user_id"] = $request->user()->id;
        Post::create($data);
        return redirect('/admin/posts')->with('success', 'Post saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function admin_show(Post $post)
    {
        $title = $post->title;
        return view('admin.posts.view-post', compact('post', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function admin_edit(Post $post)
    {
        $title = "Edit Post #" . $post->id;
        return view('admin.posts.edit-post', compact('post', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function admin_update(PostUpdateRequest $request, Post $post)
    {
        $data = $request->all();
        $post->update($data);
        return redirect('/admin/posts')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function admin_destroy(Post $post)
    {
        Comment::where("post_id", $post->id)->delete();
        $post->delete();
        return redirect('/admin/posts')->with('success', 'Post successfully deleted.');
    }

}

