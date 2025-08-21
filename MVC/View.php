<?php
    /**
     * Handles display of view
     */
    namespace MVC;

    use \eftec\bladeone\BladeOne, lib\Util as u, lib\DBG as d, lib\Logger as log;

    define ("views", root . "/App/Views");
    define ("cache", root . "/cache");

    class View {
        private $vars = [];
        private $template_name = '';
        private $blade;

        public function __construct() {
            log::v("Initializing View");
            $username = '';
            $role = null;
            $permission = [];
            log::v("Initiating 3rd party library eftec/bladeone");
            $this->blade = new BladeOne(views,cache,BladeOne::MODE_AUTO);
            // Check if User is logged in
            if (isset($_SESSION['username'])) {
                $username = u::decryptData($_SESSION['username'], session_id());
                $this->blade->setAuth($username);//, $role, $permission);
            }
            // check if $role != null
            
            // check if $permisssion != null

            
            
        }
        
        public function output(){
            log::v("Passing control to bladeone");
            return $this->blade->run($this->template_name, $this->vars); 
        }

        public function set_template_name($template_name) {
            $this->template_name = $template_name;
        }
        
        public function add_vars($key,$val) {
            $this->vars[$key] = $val;
        }
    }