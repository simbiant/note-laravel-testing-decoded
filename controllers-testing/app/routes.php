<?php

// Route::get('posts', function () {
//     $posts = Post::all();
//     return View::make('posts.index', ['posts' => $posts]);
// });

Route::resource('posts', 'PostsContoller');
