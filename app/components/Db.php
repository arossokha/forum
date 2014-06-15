<?php

    class Db {
        protected static $_inst;
        protected $_pdo;

        protected function __construct() {

        }

        public static function inst() {

            if(empty(self::$_inst)) {
                self::$_inst = new Db();
                self::$_inst->connect(require(App::getAppPath().'config'.DS.'db.php'));
            }

            return self::$_inst;
        }

        protected function connect($config) {
            $this->_pdo = new PDO( $config['dsn'], $config['username'], $config['password']);
            $this->_pdo->exec('SET NAMES '.$this->_pdo->quote($config['charset'] ? : 'utf8'));
        }

        public function queryAll($sql, $params) {
            $st = $this->_pdo->query($sql);
            
            /**
             * @todo normal error handling
             * @error when table have no rows we got $st = false
             */

            if(!$st && $this->_pdo->errorCode > 0) {
                throw new Exception("PDO #{$this->_pdo->errorCode}: {$this->_pdo->errorInfo}");
            }

            if(!empty($params) && is_array($params)) {
                foreach ($params as $key => $value) {
                    $st->bindValue($key,$value);
                }
            }

            return $st->fetchAll();
        }
    }