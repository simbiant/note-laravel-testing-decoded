<?php

trait ModelHelpers
{
    public function assertValid($model)
    {
        $this->assertTrue(
            $model->validate(),
            'Model did pass validation.'
        );
    }

    public function assertNotValid($model)
    {
        $this->assertFalse(
            $model->validate(),
            'Model did not pass validation.'
        );
    }
}
