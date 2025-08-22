<?php
    /**
     * Handles User Interaction and Data Manipulation
     */
    namespace MVC;
    use lib\Singleton, MVC\Config, lib\Logger as log;


    class CoreController extends Singleton {

        public static function getController():self {
            return self::getInstance();
        }

        public function start(){
            log::v("Executing CoreController->start()");
            
            $router = Router::get_router();

            require_once root . "/App/Routes/web.php";
            require_once root . "/App/Routes/api.php";

            $method = $_SERVER['REQUEST_METHOD']??'/';
            $uri = $_SERVER['REQUEST_URI']??'GET';

            $router->route($method, $uri);
        }
    }