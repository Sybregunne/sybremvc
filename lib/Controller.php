<?php
    namespace lib;
    use MVC\View;

    class Controller {
        protected $view;

        public function __construct() {
            $this->view = new View();
        }

        public function show() {
            echo $this->view->output();
        }

        public function add_vars($key, $val) {
            $this->view->add_vars($key, $val);
        }

        public function set_template_name($filename) {
            $this->view->set_template_name($filename);
        }
    }