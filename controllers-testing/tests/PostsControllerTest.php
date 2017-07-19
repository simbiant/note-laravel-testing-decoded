<?php

class PostsControllerTest extends TestCase
{
    public function testIndex()
    {
        // @return Symfony\Component\DomCrawler\Crawler
        // $this->client->request('GET', 'posts');

        // Use action method
        // $this->action('GET', 'PostsController@index');

        // @return Illuminate\Http\Response
        $this->call('GET', '/');
        $this->assertViewHas('posts');
    }

    public function testShow()
    {
        $this->action('GET', 'PostsController@show', ['id' => 1]);
    }
}
