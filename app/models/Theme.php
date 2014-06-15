<?php

    class Theme extends Model {

        public static function getTableName() {
            return 'Theme';
        }

        public function getAttributeNames() {
            return array(
                'themeId' => 'Theme ID',
                'name' => 'Theme name',
            );
        }

        public function getPrimaryKeyName() {
            return 'themeId';
        }

    }