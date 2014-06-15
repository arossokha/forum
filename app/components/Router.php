<?php

    class Router extends Singleton {

        public static function inst() {

            if(empty(static::$_inst)) {
                static::$_inst = new Router();
            }

            return static::$_inst;
        }

        const ROUTER_PARAM_NAME = '__r';
        protected  $defaultRoute= 'site/index';

        public function processRequest($request) {
            if(isset($request[self::ROUTER_PARAM_NAME])) {
                return $request[self::ROUTER_PARAM_NAME];
            }

            return $this->defaultRoute;
        }

    }