<?php
    define('DS',DIRECTORY_SEPARATOR);
    include_once('components/Autoloader.php');

    class App extends Singleton {

        protected $_controller;
        protected $_router;

        public static function getRootPath() {
            return dirname(dirname(__FILE__));
        }
        
        public static function getAppPath() {
            return dirname(__FILE__).DS;
        }

        public static function inst() {

            if(empty(static::$_inst)) {
                static::$_inst = new App();
                set_error_handler(array(static::$_inst,'errorHandler'),E_ALL & ~E_WARNING & ~E_NOTICE);
                set_exception_handler(array(static::$_inst,'exceptionHandler'));
            }

            return static::$_inst;
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
            /**
             * @todo Routing 
             */
            $this->_router = new Router();

            $route = $this->_router->processRequest($_REQUEST);

            list($controller, $action) = explode('/',$route);
            $controllerName = ucfirst($controller).'Controller';
            if(!class_exists($controllerName)) {
                throw new Exception("Controller '{$controllerName}' not available");
            }
            if(!is_subclass_of($controllerName,'Controller')) {
                throw new Exception("Controller '{$controllerName}' not extended from 'Controller' class");
            }

            $this->_controller = new $controllerName();


            $this->_controller->run($action);
        }

    }