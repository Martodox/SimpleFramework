<?php

class Upload
{

    protected $directory;
    protected $rootDir;
    protected $newFileName;

    public function __construct()
    {
        $this->rootDir = strstr(getcwd(), 'includes', true);
    }

    public function setDirectory($dir)
    {
        $this->directory = $this->rootDir . 'storage/upload/' . $dir . '/';
        return $this;
    }

    public function setNewFileName($newFileName)
    {
        $this->newFileName = $newFileName;
        return $this;
    }

    public function upload($file)
    {
        $nazwa = explode(".", basename($file['name']));
        $nazwa = $this->newFileName . "." . $nazwa[count($nazwa) - 1];
        if (!is_dir($this->directory)) {
            mkdir($this->directory, 0777);
        }

        $fileToUpload = $this->directory . $nazwa;
        move_uploaded_file($file['tmp_name'], $fileToUpload);
        return $nazwa;
    }

    public function remove($file)
    {

        unlink($this->directory . $file);
    }

}
