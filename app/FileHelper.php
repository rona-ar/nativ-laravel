<?php

namespace App;

use Illuminate\Support\Str;

class FileHelper
{
    private $file;
    private $filename;
    private $object;
    private $objectField;
    private $destination;
    private $driver;

    function __construct($request)
    {
        $file = (is_string($request)) ? request()->file($request) : $request;
        $this->file = $file;
        $this->filename = Str::orderedUuid();
        $this->driver = 'local';
    }

    public static function upload($request)
    {
        return new static($request);
    }

    function filename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    function attach($object, $objectField)
    {
        $this->object = $object;
        $this->objectField = $objectField;
        return $this;
    }

    public function destination($path)
    {
        $this->destination = $path;
        return $this;
    }

    function save()
    {
        if (!$this->file) return;
        $file = $this->file;
        $extension = $file->extension();
        $filename = $this->filename . "." . $extension;
        $url = $file->storeAs($this->destination, $filename);
        if ($this->object) {
            $this->object->{$this->objectField} = $url;
            $this->object->save();
        }
        return $url;
    }

    public static function destroy($path)
    {
        if (!$path) return;
        $filepath = public_path($path);
        if (file_exists($filepath) && !is_dir($filepath)) unlink($filepath);
    }

    public static function copy($from, $to)
    {
        $from_path = base_path("../$from");
        $to_path = base_path("../$to");
        $dir_path = dirname($to_path);
        if (!is_dir($dir_path)) mkdir($dir_path, 777, true);
        copy($from_path, $to_path);
        return $to;
    }
}
