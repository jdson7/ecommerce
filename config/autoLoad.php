<?php

namespace config;

/**
 * Do require of files needed. Must put "use" before the call.
 */
spl_autoload_register(function ($class) {
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/ecommerce/' . str_replace('\\', '/', $class) . '.php')){
        require $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/' . str_replace('\\', '/', $class) . '.php';
    }
});