<?php

class BaseModelTest extends TestCase
{
    protected $model;

    public function setUp()
    {
        parent::setUp();
        $this->model = $model = new BaseModel;
        $model::$rules = ['title' => 'required'];
    }

    public function testReturnsTrueIfValidationPasses()
    {
        Validator::shouldReceive('make')->once()->andReturn(
            Mockery::mock(['passes' => true])
        );

        $this->model->title = 'Foo Title';
        $result = $this->model->validate();

        $this->assertTrue($result);
    }

    public function testSetsErrorsOnObjectIfValidationFails()
    {
        Validator::shouldReceive('make')->once()->andReturn(
            Mockery::mock(['passes' => false, 'message' => 'message'])
        );
        $this->assertFalse($this->model->validate());
        $this->assertEquals('messages', $this->model->errors);
    }
}
