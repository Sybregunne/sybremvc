<?php
    namespace Routes;

    use MVC\Router;
    
    $router->post("/api/add","App\Controllers\HomeController@add");