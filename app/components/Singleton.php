<?php

    class Singleton {
        protected static $_inst;
        protected function __construct() {}
        protected function __clone() {}

        public static function inst() {
            throw new Exception("Method not implemented");
        }
    }