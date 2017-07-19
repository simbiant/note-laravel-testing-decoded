<?php
namespace App;

class MyClass
{
    public function getOption($option)
    {
        return config($option);
    }

    public function fire()
    {
        $timeout = $this->getOption('timeout');
    }
}
