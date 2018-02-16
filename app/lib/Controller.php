<?php

namespace base\lib;

abstract class Controller extends Base
{
    public function render($data, $file)
    {
        $className = strtolower(get_called_class());
        $explodedName = explode('\\', $className);
        $path = __DIR__.'/../views/'.end($explodedName).'/'.$file;

        parent::render($data, $path);
    }
}