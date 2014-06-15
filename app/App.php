<?php
    define('DS',DIRECTORY_SEPARATOR);
    /**
     * @todo Add error handling
     */

    include_once('components/Autoloader.php');

    class App {

        protected static $_inst;
        protected $_controller;

        protected function __construct() {

        }

        public static function getRootPath() {
            return dirname(dirname(__FILE__));
        }
        
        public static function getAppPath() {
            return dirname(__FILE__).DS;
        }

        public static function inst() {

            if(empty(self::$_inst)) {
                self::$_inst = new App();
                set_error_handler(array(self::$_inst,'errorHandler'),E_ALL & ~E_WARNING & ~E_NOTICE);
                set_exception_handler(array(self::$_inst,'exceptionHandler'));
            }

            return self::$_inst;
        }

        public static function errorHandler( $errno , $errstr , $errfile = '' , $errline = 0, $errcontext = array() ) {
            var_dump(get_defined_vars());
            die();
        }

        public static function exceptionHandler($ex) {
            echo "Uncaught exception: " . $ex->getMessage(). "\n";
            echo "<pre>".$ex->getTraceAsString();
            die();
        }

        public function run() {
            $this->_controller = new SiteController();

            $action = $_REQUEST['action'] ? : 'index';

            $this->_controller->run($action);
        }

    }