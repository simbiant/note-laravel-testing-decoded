<?php

function link_me_to($url, $body, $parameters = null)
{
    $url = address($url);
    $attributes = $parameters ? get_attributes($parameters) : '';
    return "<a href='{$url}'{$attributes}>{$body}</a>";
}

function address($address)
{
    return "http://:{$address}";
}

function get_attributes($parameters)
{
    $attributes = '';

    foreach ($parameters as $attribute => $value) {
        $attributes .= " {$attribute}='{$value}'";
    }

    return $attributes;
}
