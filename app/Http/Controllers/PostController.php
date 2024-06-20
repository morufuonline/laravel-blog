<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Post;
use App\Models\Comment;
use App\Helpers\GeneralHelper;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function home()
    {
        //$query->whereFullText(['posts.title', 'posts.body'], $search);

        $search_fields = ['search'];
        $search = GeneralHelper::search("home", $search_fields);
        $search = $search["search"];
        $all_posts = Post::select("posts.id as id", "posts.title as title", "posts.body as body", "posts.created_at as created_at", "users.name as name")
        ->leftJoin('users', 'users.id', '=', 'posts.user_id')
        ->when($search, function ($query, $search) {
            $query->where('posts.title', 'LIKE', '%' . $search . '%')->orWhere('posts.body', 'LIKE', '%' . $search . '%');
        }, function ($query) {
            $query->orderByDesc("posts.id");
        })
        ->simplePaginate(8);
        $title = "Blog";
        return view('index', compact('all_posts', 'title'));
    }

    public function search(SearchRequest $request)
    {
        $search_fields = ['search'];
        GeneralHelper::search("home", $search_fields, 1);
        return redirect('/');
    }

    public function details($post)
    {
        $post1 = Post::select("posts.id as id", "posts.title as title", "posts.body as body", "posts.created_at as created_at", "users.name as name")->leftJoin('users', 'users.id', '=', 'posts.user_id')->where("posts.id", $post)->latest()->first();
        $comments = Comment::select("comments.body as body", "comments.created_at as created_at", "users.name as name")->leftJoin('users', 'users.id', '=', 'comments.user_id')->where("comments.post_id", $post)->get();
        $title = $post1->title;
        $post = $post1;
        return view('details', compact('post', 'title', 'comments'));
    }

    public function index()
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
        return view('posts.posts', compact('all_posts', 'title'));
    }

    public function posts_search(SearchRequest $request)
    {
        $search_fields = ['search'];
        GeneralHelper::search("posts", $search_fields, 1);
        return redirect('/posts');
    }

    public function create()
    {
        $title = "Create New Post";
        return view('posts.new-post', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        $data = $request->all();
        $data["user_id"] = $request->user()->id;
        Post::create($data);
        return redirect('/posts')->with('success', 'Post saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $title = $post->title;
        return view('posts.view-post', compact('post', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $title = "Edit Post #" . $post->id;
        return view('posts.edit-post', compact('post', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $data = $request->all();
        $det_user_id = Post::where("id", $post->id)->value("user_id");
        if($request->user()->id != $det_user_id){
            return abort(403, "Unauthorized");
        }
        $post->update($data);
        return redirect('/posts')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts')->with('success', 'Post successfully deleted.');
    }

    public function api_list_post()
    {
        $all_posts = Post::with("user:id,name")->orderBy("id", "desc")->paginate(8);
        return response()->json(PostResource::collection($all_posts), 200);
    }

    public function api_create_post(PostStoreRequest $request){
        $data = $request->all();
        $data["user_id"] = $request->user()->id;
        $post = Post::create($data);
        return new PostResource($post);
    }

}
