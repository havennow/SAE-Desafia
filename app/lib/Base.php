<?php

namespace base\lib;

abstract class Base
{
    public function render($data, $file)
    {
        extract($data);
        ob_start();
        include($file . '.php');
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }
}