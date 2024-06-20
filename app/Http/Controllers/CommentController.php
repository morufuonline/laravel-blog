<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Post;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(CommentStoreRequest $request, Post $post)
    {
        $data = $request->all();
        $data["user_id"] = $request->user()->id;
        $data["post_id"] = $post->id;
        Comment::create($data);
        return redirect('/details/' . $post->id)->with('success', 'Comment saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function api_comment(CommentStoreRequest $request, Post $post){
        $data = $request->all();
        $data["user_id"] = $request->user()->id;
        $data["post_id"] = $post->id;
        $post = Comment::create($data);
        return new CommentResource($post);
    }
}
