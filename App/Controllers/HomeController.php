<?php
    namespace App\Controllers;
    use lib\Controller, lib\Logger as log;


    class HomeController extends Controller {
        public function index() {
            log::v("Displaying: HomeController/Views.index");
            $this->add_vars("title", "SybreMVC - Home");
            $this->set_template_name("index");
            $this->show();
            log::v("Page shown successfully");
        }
    }