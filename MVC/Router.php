<?php
    namespace MVC;

    use App\Routes\Web, App\Routes\Api, lib\Logger as log, lib\Util as u;
    
    class Router {
        /**
         * Singleton design $router will hold the single instance of the Router
         */
        private static $router;     
        private $controller, $view;
        
        private function __construct(private array $routes = []) {
            log::v("Instantiating Router");
        }
        
        /**
         * This function will return the single Instance of Router to the user on demand.
         */
        public static function get_router():self {
            if (!isset(self::$router)) {
                self::$router = new self();
            }
            return self::$router;
        }

        public function get(string $uri, string $action): void {
            $this->register($uri, $action, "GET");
        }
        
        public function post(string $uri, string $action): void {
            $this->register($uri, $action, "POST");
        }
        
        public function put(string $uri, string $action): void {
            $this->register($uri, $action, "PUT");
        }
        
        public function delete(string $uri, string $action): void{
            $this->register($uri, $action, "DELETE");
        }
        
        protected function register(string $uri, string $action, string $method): void {
                log::d("Loading Route: $method($action -> $uri)");
                if(!isset($this->routes[$method])) $this->routes[$method] = [];
                list($controller, $function) = $this->extractAction($action);
                $this->routes[$method][$uri] = [
                    'controller' => $controller,
                    'method' => $function
                ];
        }
        
        protected function extractAction(string $action, string $seperator = '@'): array {
               $sepIdx = strpos($action, $seperator);
               $controller = substr($action, 0, $sepIdx);
               $function = substr($action, $sepIdx + 1, strlen($action));
               return [$controller, $function];
        }

        public function route(string $method, string $uri): bool {
            log::v("URI requested is $uri");
            if(strlen($uri)>1 && substr($uri, -1) == '/') {
               $uri = substr($uri, 0, -1);
            }
            $result = u::dataGet($this->routes, $method .".". $uri);
            if(!$result) u::abort("Route not found", 404);
            $controller = $result['controller'];
            $function = $result['method'];
            if(class_exists($controller)) {
                $controllerInstance = new $controller();
                if(method_exists($controllerInstance, $function)) {
                    $controllerInstance->$function();
                    return true;
                } else {
                    u::abort("No method {$function} on class {$controller}", 500);
                }
            } else {
                u::abort("Class {$controller} is undefined!", 500);
            }
            return false;
        }
    }