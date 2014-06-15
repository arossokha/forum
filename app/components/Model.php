<?php


    abstract class Model {

        protected $_attributes = array();

        public static function getTableName() {
            throw new Exception("Not implementded table name method");
        }

        public function getAttributeNames() {
            throw new Exception("Not implementded table name method");
        }

        public function getPrimaryKeyName() {
            throw new Exception("Not implementded primary key method");
        }

        public function getPrimaryKey() {
            return $this->_attributes[$this->getPrimaryKeyName()];
        }

        public static function find($condition = '',$params = array()) {
            $modelName = get_called_class();
            
            $tableName = $modelName::getTableName();

            $sql = 'SELECT * from '.$tableName.' '.$condition;

            $data = Db::inst()->queryAll($sql,$params);

            foreach ($data as $row) {
                $models[] = new $modelName($row);
            }

            return $models;
        }

        public function __get($name) {
            if(array_key_exists($name, $this->_attributes)) {
                return $this->_attributes[$name];
            }

            throw new Exception("No attribute '{$name}' for model ".get_called_class()." available. ");
        }

        public function __set($name, $value)
        {
            if(array_key_exists($name, $this->getAttributeNames()) ) {
                throw new Exception("Can't set attribute '{$name}' for model ".get_called_class());
            }

            $this->_attributes[$name] = $value;
        }

        public function setAttributes($attributes) {
            $attributeNames = array_keys($this->getAttributeNames());
            $this->_attributes = array_intersect_key($attributes,$this->getAttributeNames());
        }

        public function __construct($attributes = array()) {
            $this->setAttributes($attributes);
        }

    }