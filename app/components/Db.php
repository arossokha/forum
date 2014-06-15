<?php

    class Db {
        protected static $_inst;
        protected $_pdo;

        protected function __construct() {}
        protected function __clone() {}

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

        protected function prepareStatement($sql, $params) {
            $st = $this->_pdo->prepare($sql);
            
            /**
             * @todo normal error handling
             * @error when table have no rows we got $st = false
             */
            if(!$st && $this->_pdo->errorCode > 0) {
                throw new Exception("PDO #{$this->_pdo->errorCode}: {$this->_pdo->errorInfo}");
            }

            if(!empty($params) && is_array($params)) {
                foreach ($params as $key => $value) {
                    $r = $st->bindValue($key,$value);
                }
            }

            return $st;
        }

        public function queryOne($sql, $params) {
            $st = $this->prepareStatement($sql,$params);
            $st->execute();
            return $st->fetch(PDO::FETCH_ASSOC);
        }

        public function queryAll($sql, $params) {
            $st = $this->prepareStatement($sql,$params);
            $st->execute();
            return $st->fetchAll();
        }
    }