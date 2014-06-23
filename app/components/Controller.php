<?php

    abstract class Controller {

        const DEFAULT_ACTION_NAME = 'index';
        protected $_action = '';

        public $viewPath = 'views';
        public $layoutPath = 'layouts';

        public $defaultAction = 'index';
        public $layout = 'main';
        
        public $pageTitle = 'Main page';

        function run($action = '') {
            /**
             * @todo add run action method for controller
             */
            if(empty($action)) {
                $this->_action = $this->defaultAction ? : self::DEFAULT_ACTION_NAME;
            } else {
                $this->_action = $action;
            }

            $this->_action = ucfirst(strtolower($this->_action));

            if(!method_exists($this,'action'.$this->_action)) {
                throw new Exception('No action "'.$this->_action.'" available');
            }

            $this->{'action'.$this->_action}();
        }

        public function render($viewName,$data) {
            if(is_array($data)) {
                extract($data);
            }
            $viewPath = App::getAppPath().$this->viewPath.DS.$viewName.'.php';
            $layoutPath = App::getAppPath().$this->layoutPath.DS.$this->layout.'.php';
            if(file_exists($layoutPath)) {
                if(file_exists($viewPath)) {

                    ob_start();
                    include($viewPath);
                    $content = ob_get_clean();

                    ob_start();
                    include($layoutPath);
                    $fullContent = ob_get_clean();

                    ob_end_clean();

                    echo $fullContent;
                } else {
                    throw new Exception('No view "'.$viewName.'" available!');
                }
            } else {
                throw new Exception('No layout "'.$this->layout.'" available!');
            }
            
            die();
        }

        public function createUrl($url,$params = array()) {
            $r = App::inst()->getRouter();
            return "/?".$r::ROUTER_PARAM_NAME.'='.$url.'&'.http_build_query($params);
        }

    }