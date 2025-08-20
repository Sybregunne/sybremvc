<?php
    namespace MVC;

    function mvc_files($class) {
        $class = str_replace("\\","/",$class);  // replace forward slash with backslash
        $class = "$class.php";

        if (!file_exists(root."/$class")) {
            $class="vendor/$class";
        }
        if (file_exists(root."/$class")) {
            require_once(root."/$class");
        } else {
            //throw a 500 internal server error;
            require(root."/App/Views/Errors/500.blade.php");
            exit;
        }
            
    }

    spl_autoload_register("MVC\mvc_files" );