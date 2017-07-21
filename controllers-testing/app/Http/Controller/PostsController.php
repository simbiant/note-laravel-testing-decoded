<?php

use Repositories\PostRepositoryInterface as Post;

class PostsController extends BaseController
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post  = $post;
    }

    public function index()
    {
        $posts = $this->post->all();
        return view('posts.index', compact('posts'));
    }

    public function store()
    {
        $input = Input::all();
        $v = Validator::make($input, ['title' => 'required']);

        if($v->fails())
            return Redirect::route('posts.create')->withInput()->withError($v->message());

        $this->post->create($input);
        return Redirect::route('posts.index')->with('flash', 'Your post has been created!');
    }
}
