<?php
class PostRequestTest extends TestCase
{
    public function __construct()
    {
        $this->postRequest = new App\Http\Request\PostRequest;
    }

    public function testRuleSuccess()
    {
        $attributes = factory(\App\Models\Post::class)->create();
        $rules = $this->postRequest->rules();

        $validator = Validator::make($attributes, $rules);
        $passes = $validator->passes();

        $this->assertEquals(true, $passes);
    }

    public function testRuleFail()
    {
        $attributes = factory(\App\Models\Post::class)->create(['title' => null]);
        $rules = $this->postRequest->rules();

        $validator = Validator::make($attributes, $rules);
        $fails = $validator->fails();

        $this->assertEquals(false, $fails);
    }
}
