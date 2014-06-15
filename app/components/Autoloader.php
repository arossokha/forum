<?php

    class Autoloader {

        public static function autoload($className)
        {
            $rootPath = dirname(__DIR__);

            $filePath = self::findFilePath($rootPath,$className.'.php');

            if($filePath) {
                include($filePath);
                return class_exists($className,false);
            }

            return false;
        }

        protected static function findFilePath($path,$classFileName) {

            $files = scandir($path);

            foreach($files as $file) {
                if('.' == $file[0]) continue;
                if(is_dir($path.DS.$file)) {
                    $filePath = self::findFilePath($path.DS.$file,$classFileName);
                    if($filePath) return $filePath;
                } else {
                    if(is_file($path.DS.$file) && $file == $classFileName) {
                        return $path.DS.$classFileName;
                    }
                }
            }

            return false;
        }

    }

    spl_autoload_register(array('Autoloader','autoload'));