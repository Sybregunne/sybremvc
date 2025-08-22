<?php
    namespace MVC;

    use lib\Singleton;

    class Config extends Singleton {
        private $config = [];
        /* Constants */
        // KEYS 
        // App Database
        public const DB_NAME = "DB_NAME"; // Contain the app's database name
        public const DB_USER = "DB_USER"; // Contain the app's database username
        public const DB_PASS = "DB_PASS"; // Contain the app's database password

        // App Settings
        public const APP_MODE = "APP_MODE"; // Either 1 PROD or 0 MAINT 
        public const APP_ROOT = "APP_ROOT"; // Contain the app's rootpath;
        public const APP_LOG = "APP_LOG";   // Can be DEBUG, VERBOSE, WARNING, ERROR or NONE

        // Values
        // App Settings
        public const APP_MODE_MAINTAINANCE = 0;
        public const APP_MODE_PRODUCTION = 1;

        //LOG TYPES
        public const APP_LOG_DEBUG = 4;
        public const APP_LOG_VERBOSE = 3;
        public const APP_LOG_WARNING = 2;
        public const APP_LOG_ERROR = 1;
        public const APP_LOG_NONE = 0;


        private function defaults() {
            $this->config = array(
                self::APP_MODE => self::APP_MODE_PRODUCTION,
                self::APP_ROOT => dirname(__DIR__),
                self::APP_LOG => self::APP_LOG_VERBOSE,
            );
        }

        protected function __construct() {
            $this->defaults();
        }

        public function getProperty($property) {
            $result =  $this->config[$property]??null;
            return $result;
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