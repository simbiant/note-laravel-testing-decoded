<?php

class BaseModel extends Eloquent
{
    public function validate()
    {
        $v = Validate::make($this->attributes, static::$rules);
        if($v->passes()) return true;
        $this->errors = $v->messages();
        return false;
    }
}
