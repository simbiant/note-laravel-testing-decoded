<?php
use Repositories\PostRepositoryInterface;
use Post;

class EloquentPostRepository extends PostRepositoryInterface
{
    // App::bind( 'Repositories\PostRepositoryInterface', 'Repositories\EloquentPostRepository' );

    public function all()
    {
        return Post::all();
    }

    public function find($id)
    {
        return Post::find($id);
    }

    public function create($input)
    {
        return Post::create($input);
    }
}
