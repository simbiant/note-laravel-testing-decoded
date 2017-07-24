<?php

class PhotoApiTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Route::enableFilters();
        Artisan::call('migrate');
        $this->seed();
        Auth::loginUsingId(1);
    }

    public function testMustBeAuthenticated()
    {
        Auth::logout();
        $response = $this->call('GET', 'api/v1/photos');
        $this->assertEquals('Invalid credentials', $response->getContent());
    }

    public function testProvidesErrorFeedback()
    {
        $response = $this->call('GET', 'api/v1/photos');
        $data = json_decode($response->getContent());
        $this->assertEquals(false, $data->error);
    }

    public function testFetchesPhotos()
    {
        $response = $this->call('GET', 'api/v1/photos');
        $this->assertJsonStringHasKey('photos', $response->getContent());
    }

    public function testReturnsValidJson()
    {
        $response = $this->call('GET', 'api/v1/photos');
        $this->assertJson($response->getContent());
    }

    protected function assertJsonStringHasKey($key, $json)
    {
        $data = json_decode($json);
        $this->assertInternalType('array', $data->$key);
    }

    public function testUpdatesExistingPhoto()
    {
        $photo = Factory::create(App\Models\Photo::class);
        $updatedPhotoFields = ['caption' => 'Updated Photo Capiton'];

        $response = $this->call('PATCH', 'api/vi/photos/1', $updatedPhotoFields);
        $data = json_decode($response->getContent());

        $this->assertEquals('Photo has been updated', $data->message);
        $this->assertEquals('Updated Photo Caption', Photo::find(1)->caption);
    }

    public function testCanSetALimit()
    {
        Factory::create(App\Models\User::class);
        Factory::create(App\Models\Photo::class, ['user_id' => '1'])->time(2);

        $response = $this->call('GET', 'api/v1/photos?limit=1');
        $data = json_decode($response->getContent());

        $this->assertCount(1, $data->photos);
    }
}
