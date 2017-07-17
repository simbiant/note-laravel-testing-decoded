<?php
namespace App;

class Addition implements Operation
{
    public function run($num, $current)
    {
        if(is_null($current)) return $num;
        return $num + $current;
    }
}
