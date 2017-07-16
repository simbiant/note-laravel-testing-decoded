<?php

class Calculator
{
    protected $result = 0;

    public function add($num)
    {
        foreach (func_get_args() as $num) {
            if(!is_numeric($num))
                throw new InvalidArgumentException;

            $this->result += $num;
        }
    }

    public function getResult()
    {
        return $this->result;
    }
}
