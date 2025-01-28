<?php
const BASE_DIR = __DIR__;
spl_autoload_register(function ($class) {
    $path = BASE_DIR . "/" . str_replace('\\', '/', $class) . ".php";
    require $path;
});
