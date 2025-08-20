<?php
    session_start();
    
    define ('root', dirname(__DIR__));
    require_once root.'/MVC/Autoload.php';

    use lib\Logger as log;
    log::v("Booting up sybreMVC Framework");

    $controller = MVC\CoreController::getController();
    $controller->start();