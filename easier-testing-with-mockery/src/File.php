<?php

class File
{
    /**
     * Judge file exists
     * @param  string $path
     * @return boolen
     */
    public function exists($path)
    {
        return file_exists($path);
    }

    /**
     * Write data to a given file
     * @param  string $path
     * @param  string $content
     * @return mixed
     */
    public function put($path, $content)
    {
        return file_put_contents($path, $content);
    }
}
