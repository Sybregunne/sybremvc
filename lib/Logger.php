<?php
    namespace lib;
    use lib\Singleton, lib\DBG as d, MVC\Config;
    
    class Logger extends Singleton
    {
        /**
         * A file pointer resource of the log file.
         */
        private $fileHandle;

        /**
         * A timekeeper for start of session
         */
        private $startTime;

        /**
         * Constants to make sure logging is consistent
         * Logging Mode will determine what logs to include
         * Debug Mode: 
         *      - Includes variable values
         *      - will log all D, V, W, and E logs
         * Verbose Mode:
         *      - Will log calling of functions
         *      - will log all V, W, and E logs
         * Warning Mode:
         *      - Will log all warnings (i.e. improper calling of functions, wrong type of values etc.)
         *      - will log W and E logs
         * Error Mode:
         *      - Will log all user space Errors (i.e. the improper calling of functions resulting in incomplete framework execution, database not found and etc.)
         *      - Will log only errors encountered. (Most suitable for Production)
         */
        public const DEBUG = 'D',
                     VERBOSE = 'V',
                     WARNING = 'W',
                     ERROR = 'E';
        private $line = 0;
        /**
         * Since the Singleton's constructor is called only once, just a single file
         * resource is opened at all times.
         *
         * Note, for the sake of simplicity, we open the console stream instead of
         * the actual file here.
         */
        protected function __construct()
        {
            date_default_timezone_set('Asia/Manila');

            if (empty(session_id())) session_start();
            $this->fileHandle = fopen(root."/logs/".session_id(), 'a')??fopen('php://stdout','a');
            $this->startTime = microtime(true);
            
            $date = date('Y-m-d H:i:s');
            fwrite($this->fileHandle, "\t*** BEGIN: $date ***\n");
        }

        public function __destruct()
        {
            if ($this->fileHandle) {
                $executionTime = round((microtime(true) - $this->startTime) * 1000);
                fwrite($this->fileHandle, "\tTotal Execution Time: $executionTime ms\n");
                //static::v("Total Execution Time: $executionTime ms");
                fwrite($this->fileHandle, "\t*** END: ".date('Y-m-d H:i:s')."***\n\n");
                fclose($this->fileHandle);
            }
        }
        /**
         * Write a log entry to the opened file resource.
         */
        public function writeLog(string $message): void
        {
            if ($this->fileHandle) {
                
                $date = date('Y-m-d H:i:s');
                // if ($this->line==0) fwrite($this->fileHandle, "\t*** BEGIN: $date ***\n");
                $this->line++;
                fwrite($this->fileHandle, "$this->line [$date]$message\n");
            }
        }

        /**
         * Just a handy shortcut to reduce the amount of code needed to log messages
         * from the client code.
         */
        public static function log(string $message, string $type = self::VERBOSE): void
        {
            $logtype = Config::get("logtype");
            $doLogs = false;
            if ($type!='none') {}
                switch($logtype) {
                    case 'debug':
                        $doLogs=true;
                        break;
                    case 'verbose':
                        if($type!=self::DEBUG)
                            $doLogs=true;
                        break;
                    case 'warning':
                        if($type!=self::VERBOSE && $type!=self::DEBUG)
                            $doLogs=true;
                        break;
                    case 'error':
                        if($type==self::ERROR) {
                            $doLogs=true;
                        }
                        break;
            }
            $logger = static::getInstance();
            if ($doLogs) {
                $logger->writeLog("[$type] $message");
            }
        }

        public static function v(string $message) 
        {
            static::log($message,self::VERBOSE);
        }

        public static function e(string $message) 
        {
            static::log($message,self::ERROR);
        }

        public static function w(string $message) 
        {
            static::log($message,self::WARNING);
        }

        public static function d(string $message) 
        {
            static::log($message,self::DEBUG);
        }
    }