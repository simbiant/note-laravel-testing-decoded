<?php
class Generator
{
    protected $file;

    public function __construct(File $file = null)
    {
        $this->file = $file ? : new File;
    }

    public function setFile(File $file)
    {
        $this->file = $file;
    }

    protected function getContent()
    {
        return 'foo bar';
    }

    public function fire($path)
    {
        $content = $this->getContent();
        if(! $this->file->exists($path)) {
            $this->file->put($path, $content);
        }
    }
}
