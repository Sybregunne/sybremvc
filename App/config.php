<?php
    namespace App;

    use MVC\Config;
    /**
     * Sample: 
     *
     * $userSettings = array();
     * $userSettings["DB_NAME"] = "myproject";
     * $userSettings["DB_USER"] = "myprojectuser";
     * $userSettings["DB_PASS"] = "myprojectuserpass";
     */

    $config = Config::getInstance();
    $config::DB_NAME;

