<?php
    namespace MVC;

    use lib\Singleton;

    class Config extends Singleton {
        private $config = [];

        private function defaults() {
            $this->config = array(
                "mode" => "PRODUCTION", // PRODUCTION/MAINTENANCE
                "root" => dirname(__DIR__),
                "debug" => false,
                "logtype" => "error", // debug, verbose, warning, error, none
            );
        }

        protected function __construct() {
            $this->defaults();
        }

        public function getProperty($property) {
            return $this->config[$property];
        }

        public function setProperty($property, $value) {
            $this->config[$property] = $value;
        }
        
        public static function get($property) {
            $config = static::getInstance();
            return $config->getProperty($property);
        }

        public static function set($property, $value) {
            $config = static::getInstance();
            $config->setProperty($property,$value);
        }
    }