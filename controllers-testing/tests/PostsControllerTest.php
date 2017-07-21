<?php
use Illuminate\Database\Eloquent\Collection;

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

        $posts = $response->original->getData()['posts'];
        $this->assertInstanceOf(Collection::class, $posts);
    }

    public function testShow()
    {
        $this->action('GET', 'PostsController@show', ['id' => 1]);
    }

    public function setUp()
    {
        $this->mock = Mockery::mock('Eloquent', 'Post');
        $this->requestMock = Mockery::mock('PostRequest');
    }

    public function testNewIndex()
    {
        Post::shouldReceive('all')->once();
        $this->call('GET', 'posts');
        $this->assertViewHas('posts');
    }

    public function testStore()
    {
        $this->mock->shouldReceive('create')->once();
        $this->app->instance('Post', $this->mock);
        $this->call('POST', 'posts');
        $this->assertRedirectedToRoute('posts.index');
    }

    public function testStoreData()
    {
        $input = ['title' => 'My Title'];
        $this->mock->shouldReceive('create')->once()->with($input);

        $this->app->instance('Post', $this->mock);
        $this->call('POST', 'posts', $input);

        $this->assertRedirectedToRoute('posts.index');
    }

    public function testStoreFails()
    {
        $input = ['title' => ''];
        $this->call('POST', 'posts', $input);
        $this->assertRedirectedToRoute('posts.create');
        $this->assertSessionHasErrors(['title']);
    }

    public function testStoreSuccess()
    {
        $input = ['title' => 'Foo Title'];
        Post::shouldReceive('create')->once();

        $this->call('POST', 'posts', $input);
        $this->assertRedirectedToRoute('posts.index', ['flash']);
    }


    public function testStoreWithRequest()
    {
        $input = ['title' => 'Foo Title'];

        // $this->requestMock->shouldReceive('passesAuthorization')->once()->andReturn(true);
        // $this->requestMock->shouldReceive('validation')->once();
        Validator::shouldReceive('make')->once()->andReturn(Mockery::mock(['fails' => 'true']));

        $this->app->instance('PostRequest')->once();
        $this->call('POST', 'posts', $input);

        $this->assertRedirectedToRoute('posts.index', ['flash']);
    }
}
