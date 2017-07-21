<?php
namespace Way\Generators\Generators;

use Illuminate\Filesystem\Filesystem as File;

class ModelGenerator
{
    protected $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function make($path)
    {
        $name = basename($path, '.php');
        $template = $this->getTemplate($name);

        return $this->file->exists($path) ? false
            : $this->file->put($path, $template);
    }

    protected function getTemplate($name)
    {
        $path = __DIR__.'/templates/model.txt';
        $template = $this->file->get($path);
        return str_replace('{{name}}', $name, $template);
    }
}
